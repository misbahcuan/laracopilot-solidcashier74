<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trade;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

        // Update session balance
        session(['user_balance' => $user->balance]);

        $totalBalance = $user->balance;
        $totalProfit = Trade::where('user_id', $user->id)
                            ->where('status', 'completed')
                            ->sum('profit');
        $activeTrades = Trade::where('user_id', $user->id)
                            ->where('status', 'active')
                            ->count();
        $portfolioValue = $totalBalance + $totalProfit;
        $profitPercentage = $totalBalance > 0 ? round(($totalProfit / $totalBalance) * 100, 2) : 0;

        $recentTrades = Trade::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        $totalDeposits = Deposit::where('user_id', $user->id)
                                ->where('status', 'completed')
                                ->sum('amount');
        $totalWithdrawals = Withdrawal::where('user_id', $user->id)
                                    ->where('status', 'completed')
                                    ->sum('amount');
        $pendingWithdrawals = Withdrawal::where('user_id', $user->id)
                                        ->where('status', 'pending')
                                        ->count();

        return view('dashboard.index', compact(
            'user', 'totalBalance', 'totalProfit', 'activeTrades', 'portfolioValue',
            'profitPercentage', 'recentTrades', 'totalDeposits', 'totalWithdrawals',
            'pendingWithdrawals'
        ));
    }
}