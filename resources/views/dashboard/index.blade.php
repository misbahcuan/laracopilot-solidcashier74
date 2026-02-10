@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Trading Dashboard')
@section('page-subtitle', 'Welcome back, ' . session('user_name'))

@section('content')
<!-- Balance Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-dark-card to-dark-bg border border-cyber-blue/30 rounded-lg p-6 glow-card">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Balance</span>
            <span class="text-2xl">💰</span>
        </div>
        <div class="text-3xl font-bold text-white mb-1">${{ number_format($totalBalance, 2) }}</div>
        <div class="text-xs text-gray-500">Principal + Profit</div>
    </div>

    <div class="bg-gradient-to-br from-dark-card to-dark-bg border border-cyber-green/30 rounded-lg p-6 glow-card">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Profit</span>
            <span class="text-2xl">📈</span>
        </div>
        <div class="text-3xl font-bold text-cyber-green mb-1">${{ number_format($totalProfit, 2) }}</div>
        <div class="text-xs {{ $profitPercentage >= 0 ? 'text-green-400' : 'text-red-400' }}">{{ $profitPercentage >= 0 ? '+' : '' }}{{ $profitPercentage }}% Return</div>
    </div>

    <div class="bg-gradient-to-br from-dark-card to-dark-bg border border-cyber-purple/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Active Trades</span>
            <span class="text-2xl">⚡</span>
        </div>
        <div class="text-3xl font-bold text-cyber-purple mb-1">{{ $activeTrades }}</div>
        <div class="text-xs text-gray-500">Running strategies</div>
    </div>

    <div class="bg-gradient-to-br from-dark-card to-dark-bg border border-yellow-500/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Portfolio Value</span>
            <span class="text-2xl">💼</span>
        </div>
        <div class="text-3xl font-bold text-yellow-400 mb-1">${{ number_format($portfolioValue, 2) }}</div>
        <div class="text-xs text-gray-500">Total holdings</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('trading.index') }}" class="bg-gradient-to-r from-cyber-blue to-cyan-500 rounded-lg p-6 hover:opacity-90 transition-all duration-300 transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Start Trading</h3>
                <p class="text-blue-100 text-sm">Execute AI-powered trades</p>
            </div>
            <span class="text-4xl">⚡</span>
        </div>
    </a>

    <a href="{{ route('deposit.index') }}" class="bg-gradient-to-r from-cyber-green to-green-500 rounded-lg p-6 hover:opacity-90 transition-all duration-300 transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Deposit Funds</h3>
                <p class="text-green-100 text-sm">Add USDT to your account</p>
            </div>
            <span class="text-4xl">💳</span>
        </div>
    </a>

    <a href="{{ route('withdrawal.index') }}" class="bg-gradient-to-r from-cyber-purple to-purple-600 rounded-lg p-6 hover:opacity-90 transition-all duration-300 transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Withdraw</h3>
                <p class="text-purple-100 text-sm">Request withdrawal</p>
            </div>
            <span class="text-4xl">💸</span>
        </div>
    </a>
</div>

<!-- Market Overview & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Live Markets -->
    <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <span class="mr-2">📊</span> Live Markets
        </h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-dark-bg rounded-lg hover:border hover:border-cyber-blue/30 transition-all">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">₿</span>
                    <div>
                        <div class="font-bold text-white">BTC/USD</div>
                        <div class="text-xs text-gray-500">Bitcoin</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-white">$64,250.50</div>
                    <div class="text-xs text-green-400">+2.45%</div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 bg-dark-bg rounded-lg hover:border hover:border-cyber-blue/30 transition-all">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">Ξ</span>
                    <div>
                        <div class="font-bold text-white">ETH/USD</div>
                        <div class="text-xs text-gray-500">Ethereum</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-white">$3,450.25</div>
                    <div class="text-xs text-green-400">+1.85%</div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 bg-dark-bg rounded-lg hover:border hover:border-cyber-blue/30 transition-all">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">🥇</span>
                    <div>
                        <div class="font-bold text-white">XAUT/USD</div>
                        <div class="text-xs text-gray-500">Tether Gold</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-white">$2,045.75</div>
                    <div class="text-xs text-green-400">+0.55%</div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 bg-dark-bg rounded-lg hover:border hover:border-cyber-blue/30 transition-all">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">🏆</span>
                    <div>
                        <div class="font-bold text-white">PAXG/USD</div>
                        <div class="text-xs text-gray-500">Pax Gold</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-white">$2,046.20</div>
                    <div class="text-xs text-green-400">+0.58%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Trades -->
    <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <span class="mr-2">⚡</span> Recent Trades
        </h3>
        @if($recentTrades->count() > 0)
            <div class="space-y-3">
                @foreach($recentTrades as $trade)
                    <div class="flex items-center justify-between p-3 bg-dark-bg rounded-lg">
                        <div>
                            <div class="font-bold text-white">{{ $trade->symbol }}</div>
                            <div class="text-xs text-gray-500">{{ ucfirst($trade->type) }} • {{ $trade->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold {{ $trade->profit >= 0 ? 'text-cyber-green' : 'text-red-400' }}">
                                {{ $trade->profit >= 0 ? '+' : '' }}${{ number_format($trade->profit, 2) }}
                            </div>
                            <div class="text-xs {{ $trade->status === 'active' ? 'text-cyber-blue' : ($trade->status === 'completed' ? 'text-green-400' : 'text-gray-500') }}">
                                {{ ucfirst($trade->status) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <p>No recent trades</p>
                <a href="{{ route('trading.index') }}" class="text-cyber-blue hover:underline text-sm mt-2 inline-block">Start trading now</a>
            </div>
        @endif
    </div>
</div>

<!-- Transaction Summary -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-dark-card border border-green-500/20 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Deposits</span>
            <span class="text-xl">💳</span>
        </div>
        <div class="text-2xl font-bold text-cyber-green">${{ number_format($totalDeposits, 2) }}</div>
    </div>

    <div class="bg-dark-card border border-purple-500/20 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Withdrawals</span>
            <span class="text-xl">💸</span>
        </div>
        <div class="text-2xl font-bold text-cyber-purple">${{ number_format($totalWithdrawals, 2) }}</div>
    </div>

    <div class="bg-dark-card border border-yellow-500/20 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Pending Withdrawals</span>
            <span class="text-xl">⏳</span>
        </div>
        <div class="text-2xl font-bold text-yellow-400">{{ $pendingWithdrawals }}</div>
    </div>
</div>

<!-- Test Environment Notice -->
<div class="mt-8 bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-6">
    <div class="flex items-start space-x-3">
        <span class="text-2xl">⚠️</span>
        <div>
            <h4 class="font-bold text-yellow-500 mb-2">Test Environment Active</h4>
            <p class="text-gray-400 text-sm">You are currently using a controlled test environment. All trading activities are simulated for demonstration purposes. Deposits use real USDT addresses but are for testing manual confirmation workflows.</p>
        </div>
    </div>
</div>
@endsection
