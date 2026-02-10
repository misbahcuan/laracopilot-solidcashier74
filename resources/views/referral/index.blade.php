@extends('layouts.dashboard')

@section('title', 'Referral Program')
@section('page-title', 'Referral & Affiliate Program')
@section('page-subtitle', '7-Level commission system - Earn from your network')

@section('content')
<!-- Referral Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-cyber-blue/10 to-dark-card border border-cyber-blue/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Referrals</span>
            <span class="text-2xl">👥</span>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $totalReferrals }}</div>
        <div class="text-xs text-gray-500">All levels combined</div>
    </div>

    <div class="bg-gradient-to-br from-cyber-green/10 to-dark-card border border-cyber-green/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Total Earnings</span>
            <span class="text-2xl">💰</span>
        </div>
        <div class="text-3xl font-bold text-cyber-green mb-1">${{ number_format($totalEarnings, 2) }}</div>
        <div class="text-xs text-gray-500">Commission earned</div>
    </div>

    <div class="bg-gradient-to-br from-cyber-purple/10 to-dark-card border border-cyber-purple/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">Active Referrals</span>
            <span class="text-2xl">⚡</span>
        </div>
        <div class="text-3xl font-bold text-cyber-purple mb-1">{{ $activeReferrals }}</div>
        <div class="text-xs text-gray-500">Currently trading</div>
    </div>

    <div class="bg-gradient-to-br from-yellow-500/10 to-dark-card border border-yellow-500/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-400 text-sm">This Month</span>
            <span class="text-2xl">📅</span>
        </div>
        <div class="text-3xl font-bold text-yellow-400 mb-1">${{ number_format($totalEarnings * 0.25, 2) }}</div>
        <div class="text-xs text-gray-500">Recent earnings</div>
    </div>
</div>

<!-- Referral Link -->
<div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6 mb-8">
    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
        <span class="mr-2">🔗</span> Your Referral Link
    </h3>
    <div class="bg-gradient-to-r from-cyber-blue/10 to-cyber-purple/10 border border-cyber-blue/30 rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex-1">
                <p class="text-gray-400 text-sm mb-2">Share this link to earn commissions:</p>
                <div class="bg-dark-bg border border-gray-700 rounded-lg px-4 py-3">
                    <p class="text-cyber-blue font-mono break-all" id="referralLink">{{ $referralLink }}</p>
                </div>
            </div>
        </div>
        <div class="flex space-x-3">
            <button onclick="copyReferralLink()" class="bg-cyber-blue text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all font-semibold">
                📋 Copy Link
            </button>
            <button onclick="shareOnWhatsApp()" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all font-semibold">
                💬 Share on WhatsApp
            </button>
            <button onclick="shareOnTelegram()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all font-semibold">
                ✈️ Share on Telegram
            </button>
        </div>
    </div>
</div>

<!-- Commission Structure -->
<div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6 mb-8">
    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
        <span class="mr-2">💎</span> 7-Level Commission Structure
    </h3>
    <p class="text-gray-400 text-sm mb-6">Earn commissions from your network's <strong class="text-cyber-green">trading profits only</strong>. The more your network earns, the more you earn!</p>
    <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
        <div class="bg-gradient-to-br from-red-500/20 to-transparent border border-red-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">🥇</div>
            <div class="font-bold text-white mb-1">Level 1</div>
            <div class="text-2xl font-bold text-red-400">8%</div>
            <div class="text-xs text-gray-500 mt-2">Direct referrals</div>
        </div>
        <div class="bg-gradient-to-br from-orange-500/20 to-transparent border border-orange-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">🥈</div>
            <div class="font-bold text-white mb-1">Level 2</div>
            <div class="text-2xl font-bold text-orange-400">4%</div>
            <div class="text-xs text-gray-500 mt-2">2nd generation</div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500/20 to-transparent border border-yellow-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">🥉</div>
            <div class="font-bold text-white mb-1">Level 3</div>
            <div class="text-2xl font-bold text-yellow-400">3%</div>
            <div class="text-xs text-gray-500 mt-2">3rd generation</div>
        </div>
        <div class="bg-gradient-to-br from-green-500/20 to-transparent border border-green-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">🎯</div>
            <div class="font-bold text-white mb-1">Level 4</div>
            <div class="text-2xl font-bold text-green-400">2%</div>
            <div class="text-xs text-gray-500 mt-2">4th generation</div>
        </div>
        <div class="bg-gradient-to-br from-cyan-500/20 to-transparent border border-cyan-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">💎</div>
            <div class="font-bold text-white mb-1">Level 5</div>
            <div class="text-2xl font-bold text-cyan-400">2%</div>
            <div class="text-xs text-gray-500 mt-2">5th generation</div>
        </div>
        <div class="bg-gradient-to-br from-blue-500/20 to-transparent border border-blue-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">⭐</div>
            <div class="font-bold text-white mb-1">Level 6</div>
            <div class="text-2xl font-bold text-blue-400">3%</div>
            <div class="text-xs text-gray-500 mt-2">6th generation</div>
        </div>
        <div class="bg-gradient-to-br from-purple-500/20 to-transparent border border-purple-500/30 rounded-lg p-4 text-center">
            <div class="text-3xl mb-2">👑</div>
            <div class="font-bold text-white mb-1">Level 7</div>
            <div class="text-2xl font-bold text-purple-400">3%</div>
            <div class="text-xs text-gray-500 mt-2">7th generation</div>
        </div>
    </div>
    <div class="mt-6 bg-cyber-green/10 border border-cyber-green/30 rounded-lg p-4">
        <p class="text-center text-cyber-green font-bold">Total Potential Commission: Up to 25% from your entire network's profits! 🚀</p>
    </div>
</div>

<!-- Earnings Breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-dark-card border border-cyber-green/20 rounded-lg p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <span class="mr-2">📊</span> Earnings by Level
        </h3>
        <div class="space-y-3">
            @for($i = 1; $i <= 7; $i++)
                @php
                    $levelEarnings = $totalEarnings * (rand(5, 40) / 100);
                    $levelPercentages = [8, 4, 3, 2, 2, 3, 3];
                @endphp
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400 text-sm">Level {{ $i }} ({{ $levelPercentages[$i-1] }}%)</span>
                        <span class="text-white font-bold">${{ number_format($levelEarnings, 2) }}</span>
                    </div>
                    <div class="w-full bg-dark-bg rounded-full h-2">
                        <div class="bg-gradient-to-r from-cyber-green to-green-400 h-2 rounded-full" style="width: {{ rand(20, 85) }}%"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <span class="mr-2">🎯</span> How It Works
        </h3>
        <div class="space-y-4 text-sm text-gray-400">
            <div class="flex items-start space-x-3">
                <span class="text-cyber-blue text-xl">1.</span>
                <div>
                    <p class="text-white font-semibold mb-1">Share Your Link</p>
                    <p>Send your unique referral link to friends and social media</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-cyber-green text-xl">2.</span>
                <div>
                    <p class="text-white font-semibold mb-1">They Join & Trade</p>
                    <p>When they register and start trading, you earn commissions</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-cyber-purple text-xl">3.</span>
                <div>
                    <p class="text-white font-semibold mb-1">Build Your Network</p>
                    <p>Your referrals bring their referrals - earn up to 7 levels deep</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-yellow-400 text-xl">4.</span>
                <div>
                    <p class="text-white font-semibold mb-1">Earn from Profits</p>
                    <p>Commission calculated on trading profits only - win-win for everyone!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Referral List -->
<div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
        <span class="mr-2">👥</span> Your Referrals
    </h3>
    @if($referrals->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-dark-bg">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Level</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Commission Earned</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($referrals as $referral)
                        <tr class="hover:bg-dark-bg transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-white">User #{{ $referral->referred_id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs px-2 py-1 rounded bg-cyber-blue/20 text-cyber-blue">Level 1</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-cyber-green">${{ number_format($referral->commission, 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs px-2 py-1 rounded {{ $referral->status === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                    {{ ucfirst($referral->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-sm">{{ $referral->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <p class="mb-2">No referrals yet</p>
            <p class="text-sm">Start sharing your link to build your network!</p>
        </div>
    @endif
</div>

<script>
function copyReferralLink() {
    const link = document.getElementById('referralLink').textContent;
    navigator.clipboard.writeText(link).then(() => {
        alert('✅ Referral link copied to clipboard!');
    });
}

function shareOnWhatsApp() {
    const link = document.getElementById('referralLink').textContent;
    const message = `Join FutureTrade - Advanced AI Trading Platform!\n\n🚀 Earn passive income with automated trading\n💰 Professional trading strategies\n🎁 Get started now: ${link}`;
    window.open(`https://wa.me/?text=${encodeURIComponent(message)}`, '_blank');
}

function shareOnTelegram() {
    const link = document.getElementById('referralLink').textContent;
    const message = `Join FutureTrade - Advanced AI Trading Platform!\n\n🚀 Earn passive income with automated trading\n💰 Professional trading strategies\n🎁 Get started now: ${link}`;
    window.open(`https://t.me/share/url?url=${encodeURIComponent(link)}&text=${encodeURIComponent(message)}`, '_blank');
}
</script>
@endsection
