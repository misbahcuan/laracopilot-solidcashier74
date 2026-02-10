@extends('layouts.dashboard')

@section('title', 'Trading')
@section('page-title', 'AI Trading Engine')
@section('page-subtitle', 'Automated trading with real-time execution')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Trading Interface -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Market Selection -->
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">📊</span> Select Market
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($markets as $market)
                    <div class="bg-dark-bg border border-gray-700 hover:border-cyber-blue rounded-lg p-4 cursor-pointer transition-all duration-300 group">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="text-3xl">{{ $market['icon'] }}</span>
                                <div>
                                    <div class="font-bold text-white group-hover:text-cyber-blue transition-colors">{{ $market['symbol'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $market['name'] }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-white">${{ number_format($market['price'], 2) }}</div>
                                <div class="text-xs {{ $market['change'] >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $market['change'] >= 0 ? '+' : '' }}{{ $market['change'] }}%
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Trading Strategies -->
        <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">🤖</span> AI Trading Strategies
            </h3>
            <div class="space-y-4">
                <div class="bg-gradient-to-r from-cyber-blue/10 to-transparent border border-cyber-blue/30 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h4 class="font-bold text-cyber-blue">Arbitrage Trading</h4>
                                <span class="status-trading text-xs">● ACTIVE</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-3">Exploits price differences across exchanges for guaranteed profits</p>
                            <div class="flex items-center space-x-4 text-xs">
                                <span class="text-gray-500">Avg Return: <span class="text-cyber-green font-bold">+2.5%</span></span>
                                <span class="text-gray-500">Risk: <span class="text-green-400">Low</span></span>
                                <span class="text-gray-500">Duration: <span class="text-white">Real-time</span></span>
                            </div>
                        </div>
                        <button class="bg-cyber-blue text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all text-sm font-semibold">Activate</button>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-cyber-purple/10 to-transparent border border-cyber-purple/30 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h4 class="font-bold text-cyber-purple">AI Automated Trading</h4>
                                <span class="status-trading text-xs">● ACTIVE</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-3">Neural network analyzes patterns and executes optimal trades 24/7</p>
                            <div class="flex items-center space-x-4 text-xs">
                                <span class="text-gray-500">Avg Return: <span class="text-cyber-green font-bold">+4.8%</span></span>
                                <span class="text-gray-500">Risk: <span class="text-yellow-400">Medium</span></span>
                                <span class="text-gray-500">Duration: <span class="text-white">Continuous</span></span>
                            </div>
                        </div>
                        <button class="bg-cyber-purple text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all text-sm font-semibold">Activate</button>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-cyber-green/10 to-transparent border border-cyber-green/30 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h4 class="font-bold text-cyber-green">DCA System</h4>
                                <span class="status-trading text-xs">● ACTIVE</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-3">Dollar Cost Averaging reduces risk through systematic accumulation</p>
                            <div class="flex items-center space-x-4 text-xs">
                                <span class="text-gray-500">Avg Return: <span class="text-cyber-green font-bold">+3.2%</span></span>
                                <span class="text-gray-500">Risk: <span class="text-green-400">Low</span></span>
                                <span class="text-gray-500">Duration: <span class="text-white">Long-term</span></span>
                            </div>
                        </div>
                        <button class="bg-cyber-green text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all text-sm font-semibold">Activate</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Execute Trade Form -->
        <div class="bg-dark-card border border-yellow-500/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">⚡</span> Execute Trade
            </h3>
            <form action="{{ route('trading.execute') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Market Pair</label>
                        <select name="symbol" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" required>
                            <option value="">Select Market</option>
                            @foreach($markets as $market)
                                <option value="{{ $market['symbol'] }}">{{ $market['symbol'] }} - ${{ number_format($market['price'], 2) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Trade Type</label>
                        <select name="type" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" required>
                            <option value="buy">Buy (Long)</option>
                            <option value="sell">Sell (Short)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Amount (USD)</label>
                        <input type="number" name="amount" step="0.01" min="10" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" placeholder="Minimum $10" required>
                    </div>

                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Entry Price</label>
                        <input type="number" name="price" step="0.01" min="0" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" placeholder="Current market price" required>
                    </div>
                </div>

                <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4 mb-4">
                    <div class="flex items-start space-x-2">
                        <span class="text-yellow-500">⚠️</span>
                        <div class="text-sm text-gray-400">
                            <p class="font-bold text-yellow-500 mb-1">24-Hour Lock Period</p>
                            <p>Once activated, your funds will be locked for 24 hours while the AI executes optimal trading strategies. Withdrawals are disabled during this period.</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyber-blue via-cyber-purple to-cyber-green text-white font-bold py-4 rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                    🚀 Execute Trade (Start 24h Lock)
                </button>
            </form>
        </div>
    </div>

    <!-- Active Trades Sidebar -->
    <div class="space-y-6">
        <!-- Account Status -->
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Account Status</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">Available Balance</span>
                    <span class="font-bold text-cyber-green">${{ number_format($user->balance ?? 0, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">Active Trades</span>
                    <span class="font-bold text-cyber-blue">{{ $activeTrades->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">Trading Status</span>
                    <span class="status-trading text-sm font-bold">● ACTIVE</span>
                </div>
            </div>
        </div>

        <!-- Active Positions -->
        <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Active Positions</h3>
            @if($activeTrades->count() > 0)
                <div class="space-y-3">
                    @foreach($activeTrades as $trade)
                        <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-white">{{ $trade->symbol }}</span>
                                <span class="text-xs px-2 py-1 rounded {{ $trade->type === 'buy' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ strtoupper($trade->type) }}
                                </span>
                            </div>
                            <div class="space-y-1 text-xs">
                                <div class="flex justify-between text-gray-400">
                                    <span>Entry:</span>
                                    <span class="text-white">${{ number_format($trade->entry_price, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-400">
                                    <span>Amount:</span>
                                    <span class="text-white">${{ number_format($trade->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-400">
                                    <span>P/L:</span>
                                    <span class="{{ $trade->profit >= 0 ? 'text-cyber-green' : 'text-red-400' }} font-bold">
                                        {{ $trade->profit >= 0 ? '+' : '' }}${{ number_format($trade->profit, 2) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-700">
                                <div class="text-xs text-gray-500">🔒 Locked until: {{ $trade->created_at->addHours(24)->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p class="text-sm">No active positions</p>
                </div>
            @endif
        </div>

        <!-- Trading Stats -->
        <div class="bg-gradient-to-br from-cyber-blue/10 to-cyber-purple/10 border border-cyber-blue/30 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Trading Performance</h3>
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-400">Win Rate</span>
                        <span class="text-cyber-green font-bold">73.5%</span>
                    </div>
                    <div class="w-full bg-dark-bg rounded-full h-2">
                        <div class="bg-gradient-to-r from-cyber-green to-green-400 h-2 rounded-full" style="width: 73.5%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-400">Avg Profit</span>
                        <span class="text-cyber-blue font-bold">+4.2%</span>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-400">Total Trades</span>
                        <span class="text-white font-bold">{{ $activeTrades->count() + 127 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
