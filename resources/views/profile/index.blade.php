@extends('layouts.dashboard')

@section('title', 'Profile')
@section('page-title', 'Account Settings')
@section('page-subtitle', 'Manage your profile and security')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Information -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">👤</span> Profile Information
            </h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Username</label>
                        <input type="text" value="{{ $user->username }}" class="w-full bg-dark-bg border border-gray-700 text-gray-500 rounded-lg px-4 py-3" disabled>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" placeholder="+1234567890">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Country</label>
                        <input type="text" name="country" value="{{ old('country', $user->country) }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none" placeholder="United States">
                    </div>
                </div>
                <button type="submit" class="mt-6 bg-gradient-to-r from-cyber-blue to-cyber-purple text-white font-bold py-3 px-8 rounded-lg hover:opacity-90 transition-all duration-300">
                    💾 Update Profile
                </button>
            </form>
        </div>

        <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">🔒</span> Change Password
            </h3>
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Current Password</label>
                        <input type="password" name="current_password" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-purple focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">New Password</label>
                        <input type="password" name="new_password" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-purple focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm font-semibold mb-2">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-purple focus:outline-none" required>
                    </div>
                </div>
                <button type="submit" class="mt-6 bg-gradient-to-r from-cyber-purple to-purple-600 text-white font-bold py-3 px-8 rounded-lg hover:opacity-90 transition-all duration-300">
                    🔐 Change Password
                </button>
            </form>
        </div>

        <!-- NXT Token Rewards -->
        <div class="bg-gradient-to-br from-yellow-500/10 to-orange-500/10 border border-yellow-500/30 rounded-lg p-6">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <span class="mr-2">🪙</span> NXT Token Rewards
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-dark-bg border border-yellow-500/30 rounded-lg p-4">
                    <p class="text-gray-400 text-sm mb-2">Locked NXT Balance</p>
                    <p class="text-3xl font-bold text-yellow-400">{{ number_format($user->nxt_tokens ?? 0) }} NXT</p>
                    <p class="text-xs text-gray-500 mt-2">💎 Reward tokens from deposits</p>
                </div>
                <div class="bg-dark-bg border border-orange-500/30 rounded-lg p-4">
                    <p class="text-gray-400 text-sm mb-2">Token Status</p>
                    <p class="text-xl font-bold text-orange-400">🔒 LOCKED</p>
                    <p class="text-xs text-gray-500 mt-2">Release in 6 months</p>
                </div>
            </div>

            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4 mb-4">
                <div class="flex items-start space-x-2">
                    <span class="text-yellow-500">⏰</span>
                    <div class="text-sm text-gray-400">
                        <p class="font-bold text-yellow-500 mb-2">Lock Release Countdown</p>
                        <p class="text-2xl font-bold text-white" id="tokenCountdown">180 Days</p>
                        <p class="text-xs mt-2">Tokens will be tradable after lock period ends</p>
                    </div>
                </div>
            </div>

            <div class="bg-dark-bg border border-gray-700 rounded-lg p-4">
                <h4 class="font-bold text-white mb-3">📊 Reward Tiers</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-gray-400">
                        <span>$10 deposit →</span>
                        <span class="text-yellow-400 font-bold">1,000 NXT</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>$50 deposit →</span>
                        <span class="text-yellow-400 font-bold">5,000 NXT</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>$100 deposit →</span>
                        <span class="text-yellow-400 font-bold">10,000 NXT</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>$1,000 deposit →</span>
                        <span class="text-yellow-400 font-bold">100,000 NXT</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>$5,000 deposit →</span>
                        <span class="text-yellow-400 font-bold">500,000 NXT</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>$10,000 deposit →</span>
                        <span class="text-yellow-400 font-bold">1,000,000 NXT</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-blue-500/10 border border-blue-500/30 rounded-lg p-3 text-xs text-gray-400">
                <p><strong class="text-blue-400">ℹ️ Token Info:</strong> NXT tokens are funded by 5% of the 10% withdrawal fee. Tokens will be added to DEX liquidity pool after lock period for trading.</p>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Account Overview -->
        <div class="bg-dark-card border border-cyber-green/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Account Overview</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">User ID:</span>
                    <span class="text-white font-bold">#{{ $user->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Referral Code:</span>
                    <span class="text-cyber-blue font-bold">{{ $user->referral_code }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Account Balance:</span>
                    <span class="text-cyber-green font-bold">${{ number_format($user->balance, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">NXT Tokens:</span>
                    <span class="text-yellow-400 font-bold">{{ number_format($user->nxt_tokens ?? 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Member Since:</span>
                    <span class="text-white">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Security</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">Two-Factor Auth</span>
                    <span class="text-xs px-2 py-1 rounded bg-yellow-500/20 text-yellow-400">Coming Soon</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">Email Notifications</span>
                    <span class="text-xs px-2 py-1 rounded bg-green-500/20 text-green-400">Enabled</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">API Access</span>
                    <span class="text-xs px-2 py-1 rounded bg-gray-500/20 text-gray-400">Disabled</span>
                </div>
            </div>
        </div>

        <!-- Account Actions -->
        <div class="bg-gradient-to-br from-red-500/10 to-transparent border border-red-500/30 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">Account Actions</h3>
            <div class="space-y-3">
                <button class="w-full bg-red-500/20 text-red-400 border border-red-500 py-2 rounded-lg hover:bg-red-500/30 transition-all text-sm font-semibold">
                    🗑️ Delete Account
                </button>
                <button class="w-full bg-yellow-500/20 text-yellow-400 border border-yellow-500 py-2 rounded-lg hover:bg-yellow-500/30 transition-all text-sm font-semibold">
                    📧 Export Data
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
