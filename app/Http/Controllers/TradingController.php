<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trade;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TradingController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        
        if (!$user) {
            session()->flush();
            return redirect()->route('login');
        }

        $activeTrades = Trade::where('user_id', $user->id)
                            ->where('status', 'active')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('trading.index', compact('user', 'activeTrades'));
    }

    public function execute(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->withErrors(['error' => 'Please login first']);
        }

        // Validate request
        $request->validate([
            'symbol' => 'required|string',
            'type' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:10',
            'price' => 'required|numeric|min:0',
            'strategy' => 'required|string'
        ]);

        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'User not found']);
        }

        // Check sufficient balance
        if ($user->balance < $request->amount) {
            return back()->withErrors([
                'amount' => 'Insufficient balance. Your current balance is $' . number_format($user->balance, 2) . '. Please deposit funds first.'
            ])->withInput();
        }

        // Check if user has active trades (optional: limit to prevent abuse)
        $activeTradesCount = Trade::where('user_id', $user->id)
                                  ->where('status', 'active')
                                  ->count();

        if ($activeTradesCount >= 5) {
            return back()->withErrors([
                'amount' => 'Maximum 5 active trades allowed simultaneously. Please wait for existing trades to complete.'
            ])->withInput();
        }

        // Deduct balance immediately (funds are locked)
        $user->balance -= $request->amount;
        $user->save();
        
        // Update session balance
        session(['user_balance' => $user->balance]);

        // Create trade record with 24-hour lock
        $trade = Trade::create([
            'user_id' => $user->id,
            'symbol' => $request->symbol,
            'type' => $request->type,
            'amount' => $request->amount,
            'entry_price' => $request->price,
            'exit_price' => null,
            'profit' => 0,
            'status' => 'active',
            'strategy' => $request->strategy ?? 'manual'
        ]);

        // Log trade execution
        \Log::info('Trade Executed', [
            'user_id' => $user->id,
            'trade_id' => $trade->id,
            'symbol' => $request->symbol,
            'amount' => $request->amount,
            'price' => $request->price,
            'strategy' => $request->strategy,
            'timestamp' => now()
        ]);

        return redirect()->route('trading.index')
            ->with('success', '🚀 Trade Executed Successfully! Your investment of $' . number_format($request->amount, 2) . ' is now active. Funds are locked for 24 hours while AI optimizes your trade. You will receive profits based on real market movements from CoinGecko API.');
    }

    public function history()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        
        if (!$user) {
            session()->flush();
            return redirect()->route('login');
        }

        $trades = Trade::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);

        $totalInvested = Trade::where('user_id', $user->id)->sum('amount');
        $totalProfit = Trade::where('user_id', $user->id)
                           ->where('status', 'completed')
                           ->sum('profit');
        $activeTrades = Trade::where('user_id', $user->id)
                            ->where('status', 'active')
                            ->count();
        $completedTrades = Trade::where('user_id', $user->id)
                                ->where('status', 'completed')
                                ->count();

        return view('trading.history', compact(
            'user', 'trades', 'totalInvested', 'totalProfit', 
            'activeTrades', 'completedTrades'
        ));
    }

    /**
     * Cron job method to complete trades after 24 hours
     * Run this via Laravel Scheduler: php artisan schedule:run
     */
    public function completeTrades()
    {
        // Find trades that are 24+ hours old and still active
        $trades = Trade::where('status', 'active')
                      ->where('created_at', '<=', Carbon::now()->subHours(24))
                      ->get();

        foreach ($trades as $trade) {
            // Fetch current price from CoinGecko
            $currentPrice = $this->fetchCurrentPrice($trade->symbol);
            
            // Calculate profit based on entry vs exit price
            $priceChange = (($currentPrice - $trade->entry_price) / $trade->entry_price) * 100;
            
            // Apply strategy multiplier (simulate AI optimization)
            $strategyMultiplier = $this->getStrategyMultiplier($trade->strategy ?? 'manual');
            $profit = ($trade->amount * $priceChange / 100) * $strategyMultiplier;
            
            // Update trade
            $trade->exit_price = $currentPrice;
            $trade->profit = $profit;
            $trade->status = 'completed';
            $trade->save();

            // Return funds + profit to user
            $user = User::find($trade->user_id);
            if ($user) {
                $user->balance += ($trade->amount + $profit);
                $user->save();
                
                \Log::info('Trade Completed', [
                    'trade_id' => $trade->id,
                    'user_id' => $user->id,
                    'profit' => $profit,
                    'new_balance' => $user->balance
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'completed' => $trades->count()
        ]);
    }

    private function fetchCurrentPrice($symbol)
    {
        // Map symbols to CoinGecko IDs
        $symbolMap = [
            'BTC/USD' => 'bitcoin',
            'ETH/USD' => 'ethereum',
            'XAUT/USD' => 'tether-gold',
            'PAXG/USD' => 'pax-gold'
        ];

        $coinId = $symbolMap[$symbol] ?? 'bitcoin';

        try {
            $response = file_get_contents(
                "https://api.coingecko.com/api/v3/simple/price?ids={$coinId}&vs_currencies=usd"
            );
            $data = json_decode($response, true);
            return $data[$coinId]['usd'] ?? 0;
        } catch (\Exception $e) {
            \Log::error('CoinGecko API Error: ' . $e->getMessage());
            return 0;
        }
    }

    private function getStrategyMultiplier($strategy)
    {
        $multipliers = [
            'arbitrage' => 1.1,  // 10% boost
            'ai-trading' => 1.15, // 15% boost
            'dca' => 1.08,       // 8% boost
            'manual' => 1.0      // No boost
        ];

        return $multipliers[$strategy] ?? 1.0;
    }
}