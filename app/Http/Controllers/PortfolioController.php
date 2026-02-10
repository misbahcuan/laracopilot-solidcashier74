<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trade;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));

        $totalInvested = Trade::where('user_id', $user->id)->sum('amount');
        $totalProfit = Trade::where('user_id', $user->id)
                            ->where('status', 'completed')
                            ->sum('profit');
        $portfolioValue = $user->balance + $totalInvested;

        $assetDistribution = [
            ['asset' => 'Bitcoin (BTC)', 'value' => $totalInvested * 0.40, 'percentage' => 40],
            ['asset' => 'Ethereum (ETH)', 'value' => $totalInvested * 0.30, 'percentage' => 30],
            ['asset' => 'Tether Gold (XAUT)', 'value' => $totalInvested * 0.20, 'percentage' => 20],
            ['asset' => 'Pax Gold (PAXG)', 'value' => $totalInvested * 0.10, 'percentage' => 10]
        ];

        $activeTrades = Trade::where('user_id', $user->id)
                            ->where('status', 'active')
                            ->get();

        $completedTrades = Trade::where('user_id', $user->id)
                                ->where('status', 'completed')
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();

        return view('portfolio.index', compact(
            'user', 'portfolioValue', 'totalInvested', 'totalProfit',
            'assetDistribution', 'activeTrades', 'completedTrades'
        ));
    }

    public function performance()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        return view('portfolio.performance', compact('user'));
    }
}