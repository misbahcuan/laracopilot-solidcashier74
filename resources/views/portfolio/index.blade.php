@extends('layouts.dashboard')

@section('title', 'Portfolio')
@section('page-title', 'Portfolio Overview')
@section('page-subtitle', 'Track your investments and performance')

@section('content')
<!-- Portfolio Summary -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-cyber-blue/10 to-dark-card border border-cyber-blue/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Portfolio Value</span>
            <span class="text-2xl">💼</span>
        </div>
        <div class="text-3xl font-bold text-white mb-1">${{ number_format($portfolioValue, 2) }}</div>
        <div class="text-xs text-gray-500">Total assets value</div>
    </div>

    <div class="bg-gradient-to-br from-cyber-green/10 to-dark-card border border-cyber-green/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Invested</span>
            <span class="text-2xl">💰</span>
        </div>
        <div class="text-3xl font-bold text-cyber-blue mb-1">${{ number_format($totalInvested, 2) }}</div>
        <div class="text-xs text-gray-500">Active capital</div>
    </div>

    <div class="bg-gradient-to-br from-cyber-purple/10 to-dark-card border border-cyber-purple/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Profit</span>
            <span class="text-2xl">📈</span>
        </div>
        <div class="text-3xl font-bold text-cyber-green mb-1">${{ number_format($totalProfit, 2) }}</div>
        <div class="text-xs text-gray-500">Realized gains</div>
    </div>

    <div class="bg-gradient-to-br from-yellow-500/10 to-dark-card border border-yellow-500/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">ROI</span>
            <span class="text-2xl">🎯</span>
        </div>
        <div class="text-3xl font-bold text-yellow-400 mb-1">{{ $totalInvested > 0 ? round(($totalProfit / $totalInvested) * 100, 2) : 0 }}%</div>
        <div class="text-xs text-gray-500">Return on investment</div>
    </div>
</div>

<!-- Asset Distribution -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <span class="mr-2">📊</span> Asset Distribution
        </h3>
        <div class="space-y-4">
            @foreach($assetDistribution as $asset)
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400 text-sm">{{ $asset['asset'] }}</span>
                        <span class="text-white font-bold">${{ number_format($asset['value'], 2) }} ({{ $asset['percentage'] }}%)</span>
                    </div>
                    <div class="w-full bg-dark-bg rounded-full h-3">
                        <div class="bg-gradient-to-r from-cyber-blue to-cyber-purple h-3 rounded-full transition-all duration-500" style="width: {{ $asset['percentage'] }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <span class="mr-2">🎯</span> Performance Metrics
        </h3>
        <div class="space-y-4">
            <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm">Best Performing Asset</p>
                        <p class="text-white font-bold mt-1">Bitcoin (BTC)</p>
                    </div>
                    <span class="text-2xl">₿</span>
                </div>
                <p class="text-cyber-green text-sm mt-2">+18.5% this month</p>
            </div>
            <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm">Most Stable Asset</p>
                        <p class="text-white font-bold mt-1">Tether Gold (XAUT)</p>
                    </div>
                    <span class="text-2xl">🥇</span>
                </div>
                <p class="text-yellow-400 text-sm mt-2">+2.3% this month</p>
            </div>
            <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm">Total Trading Volume</p>
                        <p class="text-white font-bold mt-1">${{ number_format($totalInvested * 2.5, 2) }}</p>
                    </div>
                    <span class="text-2xl">⚡</span>
                </div>
                <p class="text-gray-500 text-sm mt-2">Last 30 days</p>
            </div>
        </div>
    </div>
</div>

<!-- Active Positions -->
<div class="bg-dark-card border border-cyber-green/20 rounded-lg p-6 mb-8">
    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
        <span class="mr-2">⚡</span> Active Positions
    </h3>
    @if($activeTrades->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-dark-bg">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Market</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Entry Price</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">P/L</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($activeTrades as $trade)
                        <tr class="hover:bg-dark-bg transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-white">{{ $trade->symbol }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs px-2 py-1 rounded {{ $trade->type === 'buy' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ strtoupper($trade->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">${{ number_format($trade->entry_price, 2) }}</td>
                            <td class="px-6 py-4 text-white">${{ number_format($trade->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold {{ $trade->profit >= 0 ? 'text-cyber-green' : 'text-red-400' }}">
                                    {{ $trade->profit >= 0 ? '+' : '' }}${{ number_format($trade->profit, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-trading text-xs font-bold">● {{ strtoupper($trade->status) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <p>No active positions</p>
            <a href="{{ route('trading.index') }}" class="text-cyber-blue hover:underline text-sm mt-2 inline-block">Start trading →</a>
        </div>
    @endif
</div>

<!-- Completed Trades -->
<div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
        <span class="mr-2">📋</span> Recent Completed Trades
    </h3>
    @if($completedTrades->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-dark-bg">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Market</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Profit/Loss</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($completedTrades as $trade)
                        <tr class="hover:bg-dark-bg transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-white">{{ $trade->symbol }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs px-2 py-1 rounded {{ $trade->type === 'buy' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ strtoupper($trade->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white">${{ number_format($trade->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold {{ $trade->profit >= 0 ? 'text-cyber-green' : 'text-red-400' }}">
                                    {{ $trade->profit >= 0 ? '+' : '' }}${{ number_format($trade->profit, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm">{{ $trade->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <p>No completed trades yet</p>
        </div>
    @endif
</div>
@endsection
