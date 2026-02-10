<?php

namespace App\Http\Controllers\;

use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;

class TradingController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);
        $activeTrades = Trade::where('user_id', $userId)->where('status', 'active')->get();

        $markets = [
            ['symbol' => 'BTC/USD', 'name' => 'Bitcoin', 'price' => 64250.50, 'change' => 2.45, 'icon' => '₿'],
            ['symbol' => 'ETH/USD', 'name' => 'Ethereum', 'price' => 3450.25, 'change' => 1.85, 'icon' => 'Ξ'],
            ['symbol' => 'XAUT/USD', 'name' => 'Tether Gold', 'price' => 2045.75, 'change' => 0.55, 'icon' => '🥇'],
            ['symbol' => 'PAXG/USD', 'name' => 'Pax Gold', 'price' => 2046.20, 'change' => 0.58, 'icon' => '🏆'],
            ['symbol' => 'BNB/USD', 'name' => 'Binance Coin', 'price' => 585.40, 'change' => -0.85, 'icon' => '🔶'],
            ['symbol' => 'SOL/USD', 'name' => 'Solana', 'price' => 145.60, 'change' => 4.25, 'icon' => '◎']
        ];

        return view('trading.index', compact('user', 'activeTrades', 'markets'));
    }

    public function execute(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'symbol' => 'required|string',
            'type' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:10',
            'price' => 'required|numeric|min:0'
        ]);

        $userId = session('user_id');
        $user = User::find($userId);

        if ($validated['type'] === 'buy' && $user->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Insufficient balance for this trade.']);
        }

        Trade::create([
            'user_id' => $userId,
            'symbol' => $validated['symbol'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'entry_price' => $validated['price'],
            'current_price' => $validated['price'],
            'profit' => 0.00,
            'status' => 'active'
        ]);

        if ($validated['type'] === 'buy') {
            $user->balance -= $validated['amount'];
            $user->save();
        }

        return redirect()->route('trading.index')->with('success', 'Trade executed successfully!');
    }

    public function history()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $trades = Trade::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('trading.history', compact('trades'));
    }
}