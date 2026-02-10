<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);

        $totalBalance = $user->balance ?? 10000.00;
        $totalProfit = Trade::where('user_id', $userId)->where('status', 'completed')->sum('profit');
        $activeTrades = Trade::where('user_id', $userId)->where('status', 'active')->count();
        $totalDeposits = Deposit::where('user_id', $userId)->where('status', 'completed')->sum('amount');
        $totalWithdrawals = Withdrawal::where('user_id', $userId)->where('status', 'completed')->sum('amount');
        $pendingWithdrawals = Withdrawal::where('user_id', $userId)->where('status', 'pending')->count();

        $recentTrades = Trade::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $portfolioValue = $totalBalance + $totalProfit;
        $profitPercentage = $totalBalance > 0 ? round(($totalProfit / $totalBalance) * 100, 2) : 0;

        return view('dashboard.index', compact(
            'totalBalance', 'totalProfit', 'activeTrades', 'totalDeposits',
            'totalWithdrawals', 'pendingWithdrawals', 'recentTrades',
            'portfolioValue', 'profitPercentage', 'user'
        ));
    }
}