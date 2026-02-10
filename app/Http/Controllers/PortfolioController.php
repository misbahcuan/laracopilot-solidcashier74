<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);

        $activeTrades = Trade::where('user_id', $userId)
            ->where('status', 'active')
            ->get();

        $completedTrades = Trade::where('user_id', $userId)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $totalInvested = $activeTrades->sum('amount');
        $totalProfit = Trade::where('user_id', $userId)->where('status', 'completed')->sum('profit');
        $portfolioValue = $user->balance + $totalInvested + $totalProfit;

        $assetDistribution = [
            ['asset' => 'Bitcoin (BTC)', 'value' => $totalInvested * 0.35, 'percentage' => 35],
            ['asset' => 'Ethereum (ETH)', 'value' => $totalInvested * 0.25, 'percentage' => 25],
            ['asset' => 'Tether Gold (XAUT)', 'value' => $totalInvested * 0.20, 'percentage' => 20],
            ['asset' => 'Pax Gold (PAXG)', 'value' => $totalInvested * 0.15, 'percentage' => 15],
            ['asset' => 'Others', 'value' => $totalInvested * 0.05, 'percentage' => 5]
        ];

        return view('portfolio.index', compact(
            'user', 'activeTrades', 'completedTrades', 'totalInvested',
            'totalProfit', 'portfolioValue', 'assetDistribution'
        ));
    }

    public function performance()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $trades = Trade::where('user_id', $userId)->get();

        $totalTrades = $trades->count();
        $winningTrades = $trades->where('profit', '>', 0)->count();
        $losingTrades = $trades->where('profit', '<', 0)->count();
        $winRate = $totalTrades > 0 ? round(($winningTrades / $totalTrades) * 100, 2) : 0;

        return view('portfolio.performance', compact(
            'totalTrades', 'winningTrades', 'losingTrades', 'winRate'
        ));
    }
}