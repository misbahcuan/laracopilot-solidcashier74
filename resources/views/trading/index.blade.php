@extends('layouts.dashboard')

@section('title', 'AI Trading')
@section('page-title', 'AI-Powered Trading')
@section('page-subtitle', 'Execute automated trades with advanced AI strategies')

@section('content')
<!-- Production Mode Alert -->
<div class="mb-6 bg-gradient-to-r from-red-500/10 to-orange-500/10 border border-red-500/30 rounded-lg p-4">
    <div class="flex items-start space-x-3">
        <span class="text-2xl">⚠️</span>
        <div>
            <h3 class="font-bold text-red-400 mb-1">PRODUCTION MODE - Real Investment Platform</h3>
            <p class="text-sm text-gray-300 leading-relaxed">This is a LIVE trading platform. All trades execute with real balance. Funds are locked for 24 hours during AI optimization. Profits/losses are calculated based on actual market movements from CoinGecko API.</p>
        </div>
    </div>
</div>

<!-- Real-Time Market Data -->
<div class="mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl lg:text-2xl font-bold text-white">Live Market Prices</h2>
        <div class="flex items-center space-x-2 text-xs text-gray-400">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>Real-Time Data</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="marketPrices">
        <!-- Prices loaded via JavaScript -->
        <div class="bg-dark-card border border-gray-800 rounded-lg p-4 animate-pulse">
            <div class="h-4 bg-gray-700 rounded w-20 mb-2"></div>
            <div class="h-8 bg-gray-700 rounded w-32 mb-2"></div>
            <div class="h-4 bg-gray-700 rounded w-16"></div>
        </div>
        <div class="bg-dark-card border border-gray-800 rounded-lg p-4 animate-pulse">
            <div class="h-4 bg-gray-700 rounded w-20 mb-2"></div>
            <div class="h-8 bg-gray-700 rounded w-32 mb-2"></div>
            <div class="h-4 bg-gray-700 rounded w-16"></div>
        </div>
        <div class="bg-dark-card border border-gray-800 rounded-lg p-4 animate-pulse">
            <div class="h-4 bg-gray-700 rounded w-20 mb-2"></div>
            <div class="h-8 bg-gray-700 rounded w-32 mb-2"></div>
            <div class="h-4 bg-gray-700 rounded w-16"></div>
        </div>
        <div class="bg-dark-card border border-gray-800 rounded-lg p-4 animate-pulse">
            <div class="h-4 bg-gray-700 rounded w-20 mb-2"></div>
            <div class="h-8 bg-gray-700 rounded w-32 mb-2"></div>
            <div class="h-4 bg-gray-700 rounded w-16"></div>
        </div>
    </div>
</div>

<!-- AI Trading Strategies -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
    <!-- Arbitrage Strategy -->
    <div class="bg-dark-card border border-cyber-blue/30 rounded-lg p-4 lg:p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="text-lg lg:text-xl font-bold text-white mb-2">🔄 Arbitrage AI</h3>
                <p class="text-xs lg:text-sm text-gray-400">Exploit price differences across exchanges</p>
            </div>
            <span class="px-3 py-1 bg-cyber-blue/20 text-cyber-blue text-xs rounded-full">Active</span>
        </div>
        <div class="space-y-2 mb-4">
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Expected ROI:</span>
                <span class="text-cyber-green font-bold">8-15%</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Risk Level:</span>
                <span class="text-yellow-400 font-bold">Medium</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Lock Period:</span>
                <span class="text-white font-bold">24 Hours</span>
            </div>
        </div>
        <button onclick="openTradeModal('arbitrage', 10)" class="w-full bg-gradient-to-r from-cyber-blue to-blue-600 text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all">
            Activate Strategy
        </button>
    </div>

    <!-- AI Trading Strategy -->
    <div class="bg-dark-card border border-cyber-purple/30 rounded-lg p-4 lg:p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="text-lg lg:text-xl font-bold text-white mb-2">🤖 AI Trading</h3>
                <p class="text-xs lg:text-sm text-gray-400">Machine learning predictive algorithms</p>
            </div>
            <span class="px-3 py-1 bg-cyber-purple/20 text-cyber-purple text-xs rounded-full">Active</span>
        </div>
        <div class="space-y-2 mb-4">
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Expected ROI:</span>
                <span class="text-cyber-green font-bold">12-25%</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Risk Level:</span>
                <span class="text-orange-400 font-bold">High</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Lock Period:</span>
                <span class="text-white font-bold">24 Hours</span>
            </div>
        </div>
        <button onclick="openTradeModal('ai-trading', 12)" class="w-full bg-gradient-to-r from-cyber-purple to-purple-600 text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all">
            Activate Strategy
        </button>
    </div>

    <!-- DCA Strategy -->
    <div class="bg-dark-card border border-cyber-green/30 rounded-lg p-4 lg:p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="text-lg lg:text-xl font-bold text-white mb-2">📊 DCA Strategy</h3>
                <p class="text-xs lg:text-sm text-gray-400">Dollar-cost averaging with AI timing</p>
            </div>
            <span class="px-3 py-1 bg-cyber-green/20 text-cyber-green text-xs rounded-full">Active</span>
        </div>
        <div class="space-y-2 mb-4">
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Expected ROI:</span>
                <span class="text-cyber-green font-bold">5-12%</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Risk Level:</span>
                <span class="text-green-400 font-bold">Low</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Lock Period:</span>
                <span class="text-white font-bold">24 Hours</span>
            </div>
        </div>
        <button onclick="openTradeModal('dca', 7)" class="w-full bg-gradient-to-r from-cyber-green to-green-600 text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all">
            Activate Strategy
        </button>
    </div>
</div>

<!-- Active Trades -->
@if($activeTrades->count() > 0)
<div class="mb-6">
    <h2 class="text-xl lg:text-2xl font-bold text-white mb-4">⚡ Your Active Trades</h2>
    <div class="space-y-4">
        @foreach($activeTrades as $trade)
        <div class="bg-dark-card border border-yellow-500/30 rounded-lg p-4 lg:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-4 lg:mb-0">
                    <div class="flex items-center space-x-3 mb-2">
                        <h3 class="text-lg font-bold text-white">{{ $trade->symbol }}</h3>
                        <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 text-xs rounded-full">🔒 Locked</span>
                    </div>
                    <p class="text-sm text-gray-400">Amount: <span class="text-white font-bold">${{ number_format($trade->amount, 2) }}</span></p>
                    <p class="text-sm text-gray-400">Entry: <span class="text-white font-bold">${{ number_format($trade->entry_price, 2) }}</span></p>
                </div>
                <div class="text-left lg:text-right">
                    <p class="text-xs text-gray-500 mb-1">Time Remaining</p>
                    <p class="text-2xl font-bold text-yellow-400" id="countdown-{{ $trade->id }}">--:--:--</p>
                    <p class="text-xs text-gray-500 mt-1">AI optimizing your trade...</p>
                </div>
            </div>
        </div>

        <script>
            // Countdown timer for trade #{{ $trade->id }}
            (function() {
                const createdAt = new Date('{{ $trade->created_at }}').getTime();
                const lockDuration = 24 * 60 * 60 * 1000; // 24 hours
                const unlockTime = createdAt + lockDuration;

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = unlockTime - now;

                    if (distance < 0) {
                        document.getElementById('countdown-{{ $trade->id }}').innerHTML = '00:00:00';
                        return;
                    }

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById('countdown-{{ $trade->id }}').innerHTML = 
                        String(hours).padStart(2, '0') + ':' + 
                        String(minutes).padStart(2, '0') + ':' + 
                        String(seconds).padStart(2, '0');
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            })();
        </script>
        @endforeach
    </div>
</div>
@endif

<!-- Trade Modal -->
<div id="tradeModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-dark-card border border-gray-800 rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white">Execute Trade</h3>
                <button onclick="closeTradeModal()" class="text-gray-400 hover:text-white text-2xl">&times;</button>
            </div>

            <form action="{{ route('trading.execute') }}" method="POST" id="tradeForm">
                @csrf
                <input type="hidden" name="type" value="buy">
                <input type="hidden" name="strategy" id="strategyInput">
                <input type="hidden" name="symbol" id="symbolInput">
                <input type="hidden" name="price" id="priceInput">

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Select Asset</label>
                    <select id="assetSelect" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" onchange="updateSelectedAsset()">
                        <option value="">Select cryptocurrency...</option>
                        <option value="bitcoin">Bitcoin (BTC)</option>
                        <option value="ethereum">Ethereum (ETH)</option>
                        <option value="tether-gold">Tether Gold (XAUT)</option>
                        <option value="pax-gold">Pax Gold (PAXG)</option>
                    </select>
                </div>

                <div class="mb-4" id="currentPriceDiv" style="display:none;">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Current Market Price</label>
                    <div class="bg-dark-bg border border-cyber-blue/30 rounded-lg px-4 py-3">
                        <p class="text-2xl font-bold text-cyber-blue" id="selectedAssetPrice">$0.00</p>
                        <p class="text-xs text-gray-500 mt-1">Real-time price from CoinGecko</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Investment Amount (USD)</label>
                    <input type="number" name="amount" id="amountInput" min="10" step="0.01" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" placeholder="Minimum $10" required>
                    <p class="text-xs text-gray-500 mt-2">Available Balance: <span class="text-cyber-green font-bold">${{ number_format($user->balance, 2) }}</span></p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Expected ROI</label>
                    <div class="bg-dark-bg border border-cyber-green/30 rounded-lg px-4 py-3">
                        <p class="text-xl font-bold text-cyber-green" id="expectedRoi">0%</p>
                    </div>
                </div>

                <div class="mb-6 bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4">
                    <div class="flex items-start space-x-2">
                        <span class="text-yellow-500 text-xl">⚠️</span>
                        <div class="text-sm text-gray-300">
                            <p class="font-bold text-yellow-400 mb-1">Important Information</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>Funds locked for 24 hours during AI optimization</li>
                                <li>Profits based on real market movements</li>
                                <li>Minimum investment: $10 USD</li>
                                <li>Cannot withdraw until lock period ends</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="button" onclick="closeTradeModal()" class="flex-1 bg-gray-700 text-white font-bold py-3 rounded-lg hover:bg-gray-600 transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-cyber-blue to-cyber-purple text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all">
                        🚀 Execute Trade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let marketData = {};
let selectedStrategy = '';
let expectedRoiRange = '';

// Fetch real-time prices from CoinGecko
async function fetchMarketPrices() {
    try {
        const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,tether-gold,pax-gold&vs_currencies=usd&include_24hr_change=true');
        const data = await response.json();
        marketData = data;
        updateMarketUI();
    } catch (error) {
        console.error('Error fetching prices:', error);
        setTimeout(fetchMarketPrices, 10000); // Retry after 10 seconds
    }
}

function updateMarketUI() {
    const container = document.getElementById('marketPrices');
    const assets = [
        { id: 'bitcoin', name: 'Bitcoin', symbol: 'BTC', icon: '₿', color: 'orange' },
        { id: 'ethereum', name: 'Ethereum', symbol: 'ETH', icon: 'Ξ', color: 'blue' },
        { id: 'tether-gold', name: 'Tether Gold', symbol: 'XAUT', icon: '🥇', color: 'yellow' },
        { id: 'pax-gold', name: 'Pax Gold', symbol: 'PAXG', icon: '🏆', color: 'yellow' }
    ];

    container.innerHTML = assets.map(asset => {
        const price = marketData[asset.id]?.usd || 0;
        const change = marketData[asset.id]?.usd_24h_change || 0;
        const changeColor = change >= 0 ? 'green' : 'red';
        const changeIcon = change >= 0 ? '▲' : '▼';

        return `
            <div class="bg-dark-card border border-gray-800 rounded-lg p-4 hover:border-${asset.color}-500/50 transition-all cursor-pointer">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-2xl">${asset.icon}</span>
                    <span class="text-xs px-2 py-1 rounded-full bg-${changeColor}-500/20 text-${changeColor}-400">
                        ${changeIcon} ${Math.abs(change).toFixed(2)}%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mb-1">${asset.name}</p>
                <p class="text-white font-bold text-xl lg:text-2xl">$${price.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</p>
                <p class="text-gray-500 text-xs mt-1">${asset.symbol}/USD</p>
            </div>
        `;
    }).join('');
}

function openTradeModal(strategy, roi) {
    selectedStrategy = strategy;
    expectedRoiRange = roi;
    document.getElementById('strategyInput').value = strategy;
    document.getElementById('expectedRoi').textContent = roi + '%';
    document.getElementById('tradeModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeTradeModal() {
    document.getElementById('tradeModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    document.getElementById('tradeForm').reset();
    document.getElementById('currentPriceDiv').style.display = 'none';
}

function updateSelectedAsset() {
    const assetId = document.getElementById('assetSelect').value;
    if (!assetId) {
        document.getElementById('currentPriceDiv').style.display = 'none';
        return;
    }

    const price = marketData[assetId]?.usd || 0;
    const symbolMap = {
        'bitcoin': 'BTC/USD',
        'ethereum': 'ETH/USD',
        'tether-gold': 'XAUT/USD',
        'pax-gold': 'PAXG/USD'
    };

    document.getElementById('symbolInput').value = symbolMap[assetId];
    document.getElementById('priceInput').value = price;
    document.getElementById('selectedAssetPrice').textContent = '$' + price.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById('currentPriceDiv').style.display = 'block';
}

// Form validation
document.getElementById('tradeForm')?.addEventListener('submit', function(e) {
    const amount = parseFloat(document.getElementById('amountInput').value);
    const balance = parseFloat('{{ $user->balance }}');
    const asset = document.getElementById('assetSelect').value;

    if (!asset) {
        e.preventDefault();
        alert('Please select a cryptocurrency asset');
        return;
    }

    if (amount < 10) {
        e.preventDefault();
        alert('Minimum investment is $10 USD');
        return;
    }

    if (amount > balance) {
        e.preventDefault();
        alert('Insufficient balance. Please deposit funds first.');
        return;
    }

    if (!confirm(`Execute ${selectedStrategy} trade with $${amount.toFixed(2)}? Funds will be locked for 24 hours.`)) {
        e.preventDefault();
    }
});

// Initialize
fetchMarketPrices();
setInterval(fetchMarketPrices, 30000); // Update every 30 seconds

// Close modal on outside click
document.getElementById('tradeModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeTradeModal();
    }
});
</script>
@endsection
