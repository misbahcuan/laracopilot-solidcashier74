@extends('layouts.dashboard')

@section('title', 'Deposit')
@section('page-title', 'Deposit Funds')
@section('page-subtitle', 'Add USDT to your trading account')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Deposit Form -->
    <div class="lg:col-span-2">
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">💳</span> USDT Deposit (BEP-20)
            </h3>

            <!-- Deposit Address -->
            <div class="bg-gradient-to-r from-cyber-blue/10 to-cyber-purple/10 border border-cyber-blue/30 rounded-lg p-6 mb-6">
                <div class="text-center mb-4">
                    <p class="text-gray-400 text-sm mb-2">Send USDT (BEP-20) to this address:</p>
                    <div class="bg-dark-bg border border-cyber-blue rounded-lg p-4">
                        <p class="text-cyber-blue font-mono text-lg break-all" id="depositAddress">0x6AD78978110f36Ac0D6A7E4cd5286C6C47b39585</p>
                    </div>
                    <button onclick="copyAddress()" class="mt-3 bg-cyber-blue text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all text-sm font-semibold">
                        📋 Copy Address
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-4 text-center text-sm">
                    <div>
                        <p class="text-gray-500 mb-1">Network</p>
                        <p class="text-white font-bold">BEP-20</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Asset</p>
                        <p class="text-white font-bold">USDT</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Min Deposit</p>
                        <p class="text-white font-bold">$10</p>
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4 mb-6">
                <div class="flex items-start space-x-2">
                    <span class="text-yellow-500 text-xl">⚠️</span>
                    <div class="text-sm text-gray-400">
                        <p class="font-bold text-yellow-500 mb-2">Important Instructions:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Only send USDT using BEP-20 (BSC) network</li>
                            <li>Sending other assets or wrong network will result in loss of funds</li>
                            <li>Deposits require manual confirmation by admin</li>
                            <li>Processing time: 10-30 minutes after submission</li>
                            <li>Minimum deposit: $10 USDT</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Deposit Confirmation Form -->
            <div class="bg-dark-bg border border-gray-700 rounded-lg p-6">
                <h4 class="font-bold text-white mb-4">Confirm Your Deposit</h4>
                <form action="{{ route('deposit.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="USDT BEP-20">

                    <div class="mb-4">
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Deposit Amount (USDT)</label>
                        <input type="number" name="amount" step="0.01" min="10" class="w-full bg-dark-card border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" placeholder="Enter amount you sent" required>
                        <p class="text-xs text-gray-500 mt-1">Minimum: $10 USDT</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Transaction Hash (TXID)</label>
                        <input type="text" name="transaction_id" class="w-full bg-dark-card border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none font-mono" placeholder="0x..." required>
                        <p class="text-xs text-gray-500 mt-1">Enter the transaction hash from your wallet</p>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-cyber-blue to-cyber-purple text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-300">
                        ✅ I Have Completed Deposit
                    </button>
                </form>
            </div>
        </div>

        <!-- Recent Deposits -->
        <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">📋</span> Recent Deposits
            </h3>
            @if($recentDeposits->count() > 0)
                <div class="space-y-3">
                    @foreach($recentDeposits as $deposit)
                        <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-white">${{ number_format($deposit->amount, 2) }}</span>
                                <span class="text-xs px-3 py-1 rounded-full {{ $deposit->status === 'completed' ? 'bg-green-500/20 text-green-400' : ($deposit->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                    {{ ucfirst($deposit->status) }}
                                </span>
                            </div>
                            <div class="text-xs text-gray-500">
                                <p>{{ $deposit->payment_method }}</p>
                                <p class="font-mono">{{ substr($deposit->transaction_id, 0, 20) }}...</p>
                                <p>{{ $deposit->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No deposit history</p>
                </div>
            @endif
            <a href="{{ route('deposit.history') }}" class="block text-center text-cyber-blue hover:underline text-sm mt-4">View All Deposits →</a>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-6">
        <!-- Quick Guide -->
        <div class="bg-dark-card border border-cyber-green/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">📖 How to Deposit</h3>
            <ol class="space-y-3 text-sm text-gray-400">
                <li class="flex items-start space-x-2">
                    <span class="text-cyber-green font-bold">1.</span>
                    <span>Copy the deposit address above</span>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-cyber-green font-bold">2.</span>
                    <span>Open your crypto wallet (Trust Wallet, MetaMask, Binance, etc.)</span>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-cyber-green font-bold">3.</span>
                    <span>Send USDT using BEP-20 (BSC) network</span>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-cyber-green font-bold">4.</span>
                    <span>Copy the transaction hash (TXID)</span>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-cyber-green font-bold">5.</span>
                    <span>Submit confirmation form with amount and TXID</span>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-cyber-green font-bold">6.</span>
                    <span>Wait for admin confirmation (10-30 minutes)</span>
                </li>
            </ol>
        </div>

        <!-- Supported Wallets -->
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Supported Wallets</h3>
            <div class="space-y-2 text-sm">
                <div class="flex items-center space-x-2 text-gray-400">
                    <span>✓</span>
                    <span>Trust Wallet</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-400">
                    <span>✓</span>
                    <span>MetaMask</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-400">
                    <span>✓</span>
                    <span>Binance Exchange</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-400">
                    <span>✓</span>
                    <span>Coinbase Wallet</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-400">
                    <span>✓</span>
                    <span>Any BEP-20 compatible wallet</span>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="bg-gradient-to-br from-cyber-purple/10 to-transparent border border-cyber-purple/30 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-2">Need Help?</h3>
            <p class="text-gray-400 text-sm mb-4">Contact our support team if you encounter any issues with your deposit.</p>
            <button class="w-full bg-cyber-purple text-white py-2 rounded-lg hover:opacity-90 transition-all text-sm font-semibold">
                💬 Contact Support
            </button>
        </div>
    </div>
</div>

<script>
function copyAddress() {
    const address = document.getElementById('depositAddress').textContent;
    navigator.clipboard.writeText(address).then(() => {
        alert('✅ Address copied to clipboard!');
    });
}
</script>
@endsection
