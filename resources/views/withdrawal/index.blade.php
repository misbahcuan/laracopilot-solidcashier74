@extends('layouts.dashboard')

@section('title', 'Withdrawal')
@section('page-title', 'Withdraw Funds')
@section('page-subtitle', 'Request withdrawal to your wallet')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Withdrawal Form -->
    <div class="lg:col-span-2">
        <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">💸</span> Withdrawal Request
            </h3>

            <!-- Balance Display -->
            <div class="bg-gradient-to-r from-cyber-green/10 to-transparent border border-cyber-green/30 rounded-lg p-4 mb-6">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Available Balance</p>
                        <p class="text-2xl font-bold text-cyber-green">${{ number_format($user->balance ?? 0, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">After 10% Fee</p>
                        <p class="text-2xl font-bold text-white" id="amountAfterFee">$0.00</p>
                    </div>
                </div>
            </div>

            <!-- Fee Notice -->
            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4 mb-6">
                <div class="flex items-start space-x-2">
                    <span class="text-yellow-500 text-xl">⚠️</span>
                    <div class="text-sm text-gray-400">
                        <p class="font-bold text-yellow-500 mb-2">Withdrawal Fee: 10%</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>10% fee applied to all withdrawals</li>
                            <li>5% allocated to NXT token liquidity pool</li>
                            <li>Network fee: BEP-20 (BSC) gas fee applies</li>
                            <li>Minimum withdrawal: $20 USDT</li>
                            <li>Processing time: Manual approval (24-48 hours)</li>
                            <li>Withdrawals disabled during 24-hour trading lock</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Withdrawal Form -->
            <form action="{{ route('withdrawal.store') }}" method="POST" onsubmit="return confirmWithdrawal()">
                @csrf
                <input type="hidden" name="withdrawal_method" value="USDT BEP-20">

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Withdrawal Amount (USDT)</label>
                    <input type="number" name="amount" id="withdrawAmount" step="0.01" min="20" max="{{ $user->balance ?? 0 }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-purple focus:outline-none" placeholder="Enter amount" required oninput="calculateFee()">
                    <div class="flex justify-between text-xs mt-2">
                        <span class="text-gray-500">Minimum: $20 USDT</span>
                        <span class="text-gray-500">Available: ${{ number_format($user->balance ?? 0, 2) }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Network</label>
                    <div class="bg-dark-bg border border-gray-700 rounded-lg px-4 py-3 text-white">
                        <div class="flex items-center justify-between">
                            <span>USDT - BEP-20 (BSC)</span>
                            <span class="text-xs text-cyber-green">✓ Selected</span>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Withdrawal Address (BEP-20)</label>
                    <input type="text" name="wallet_address" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-purple focus:outline-none font-mono" placeholder="0x..." required>
                    <p class="text-xs text-gray-500 mt-1">⚠️ Ensure this is a BEP-20 (BSC) compatible address</p>
                </div>

                <!-- Fee Breakdown -->
                <div class="bg-dark-bg border border-gray-700 rounded-lg p-4 mb-6">
                    <h4 class="font-bold text-white mb-3">Withdrawal Summary</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-400">
                            <span>Withdrawal Amount:</span>
                            <span class="text-white" id="summaryAmount">$0.00</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Platform Fee (10%):</span>
                            <span class="text-red-400" id="summaryFee">-$0.00</span>
                        </div>
                        <div class="border-t border-gray-700 pt-2 flex justify-between">
                            <span class="font-bold text-white">You Will Receive:</span>
                            <span class="font-bold text-cyber-green" id="summaryNet">$0.00</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyber-purple to-purple-600 text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-300">
                    💸 Submit Withdrawal Request
                </button>
            </form>
        </div>

        <!-- Recent Withdrawals -->
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">📋</span> Recent Withdrawals
            </h3>
            @if($recentWithdrawals->count() > 0)
                <div class="space-y-3">
                    @foreach($recentWithdrawals as $withdrawal)
                        <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-white">${{ number_format($withdrawal->amount, 2) }}</span>
                                <span class="text-xs px-3 py-1 rounded-full {{ $withdrawal->status === 'completed' ? 'bg-green-500/20 text-green-400' : ($withdrawal->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                    {{ ucfirst($withdrawal->status) }}
                                </span>
                            </div>
                            <div class="text-xs text-gray-500">
                                <p>{{ $withdrawal->withdrawal_method }}</p>
                                <p class="font-mono">{{ substr($withdrawal->wallet_address, 0, 15) }}...{{ substr($withdrawal->wallet_address, -10) }}</p>
                                <p>{{ $withdrawal->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No withdrawal history</p>
                </div>
            @endif
            <a href="{{ route('withdrawal.history') }}" class="block text-center text-cyber-blue hover:underline text-sm mt-4">View All Withdrawals →</a>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-6">
        <!-- Withdrawal Status -->
        <div class="bg-dark-card border border-cyber-green/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Account Status</h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Withdrawal Access:</span>
                    <span class="text-cyber-green font-bold">✓ Enabled</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Active Locks:</span>
                    <span class="text-white font-bold">0</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Pending Requests:</span>
                    <span class="text-yellow-400 font-bold">{{ $recentWithdrawals->where('status', 'pending')->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Withdrawal Methods -->
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Withdrawal Methods</h3>
            <div class="space-y-3">
                @foreach($withdrawalMethods as $method)
                    <div class="bg-dark-bg border border-gray-700 rounded-lg p-3">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl">{{ $method['icon'] }}</span>
                                <span class="text-white font-semibold text-sm">{{ $method['name'] }}</span>
                            </div>
                            <span class="text-xs text-cyber-green">{{ $method['fee'] }}</span>
                        </div>
                        <p class="text-xs text-gray-500">Network fee applies</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Processing Time -->
        <div class="bg-gradient-to-br from-cyber-purple/10 to-transparent border border-cyber-purple/30 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-3">⏱️ Processing Time</h3>
            <div class="space-y-2 text-sm text-gray-400">
                <p><strong class="text-white">Manual Approval:</strong> 24-48 hours</p>
                <p><strong class="text-white">Security Check:</strong> Required</p>
                <p><strong class="text-white">Network Confirmation:</strong> 1-5 minutes</p>
            </div>
        </div>

        <!-- Support -->
        <div class="bg-dark-card border border-yellow-500/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-2">Need Help?</h3>
            <p class="text-gray-400 text-sm mb-4">Contact support if your withdrawal is delayed beyond 48 hours.</p>
            <button class="w-full bg-yellow-500 text-black py-2 rounded-lg hover:bg-yellow-400 transition-all text-sm font-semibold">
                💬 Contact Support
            </button>
        </div>
    </div>
</div>

<script>
function calculateFee() {
    const amount = parseFloat(document.getElementById('withdrawAmount').value) || 0;
    const fee = amount * 0.10;
    const net = amount - fee;
    
    document.getElementById('amountAfterFee').textContent = '$' + net.toFixed(2);
    document.getElementById('summaryAmount').textContent = '$' + amount.toFixed(2);
    document.getElementById('summaryFee').textContent = '-$' + fee.toFixed(2);
    document.getElementById('summaryNet').textContent = '$' + net.toFixed(2);
}

function confirmWithdrawal() {
    const amount = parseFloat(document.getElementById('withdrawAmount').value);
    const net = (amount * 0.90).toFixed(2);
    return confirm(`Confirm withdrawal of $${amount}?\nAfter 10% fee, you will receive: $${net}`);
}
</script>
@endsection
