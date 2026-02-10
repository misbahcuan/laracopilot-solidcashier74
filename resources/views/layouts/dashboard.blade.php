<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - FutureTrade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyber-blue': '#00f0ff',
                        'cyber-purple': '#b537f2',
                        'cyber-green': '#00ff88',
                        'dark-bg': '#0a0e27',
                        'dark-card': '#151934'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 10px rgba(0, 240, 255, 0.3), 0 0 20px rgba(0, 240, 255, 0.1); }
            50% { box-shadow: 0 0 20px rgba(0, 240, 255, 0.6), 0 0 30px rgba(0, 240, 255, 0.3); }
        }
        .glow-card { animation: glow 3s ease-in-out infinite; }
        .status-active { color: #00ff88; }
        .status-trading { color: #00f0ff; }
        .status-locked { color: #ff6b6b; }
    </style>
</head>
<body class="bg-dark-bg text-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-dark-card to-dark-bg border-r border-cyber-blue/20">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-cyber-blue mb-8">⚡ FutureTrade</h2>
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">📊</span>
                        <span class="font-semibold">Dashboard</span>
                    </a>
                    <a href="{{ route('trading.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('trading.*') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">⚡</span>
                        <span class="font-semibold">Trading</span>
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('portfolio.*') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">💼</span>
                        <span class="font-semibold">Portfolio</span>
                    </a>
                    <a href="{{ route('deposit.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('deposit.*') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">💳</span>
                        <span class="font-semibold">Deposit</span>
                    </a>
                    <a href="{{ route('withdrawal.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('withdrawal.*') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">💸</span>
                        <span class="font-semibold">Withdraw</span>
                    </a>
                    <a href="{{ route('referral.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('referral.*') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">👥</span>
                        <span class="font-semibold">Referral</span>
                    </a>
                    <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-cyber-blue/10 text-cyber-blue border-l-4 border-cyber-blue' : 'text-gray-400 hover:bg-dark-bg hover:text-white' }} transition-all duration-300">
                        <span class="text-xl">⚙️</span>
                        <span class="font-semibold">Profile</span>
                    </a>
                </nav>
            </div>
            <div class="absolute bottom-6 left-6 right-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-all duration-300">
                        <span class="text-xl">🚪</span>
                        <span class="font-semibold">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <header class="bg-dark-card border-b border-cyber-blue/20 px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-gray-400 text-sm mt-1">@yield('page-subtitle', 'Welcome back')</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-gray-400 text-xs">Account Balance</p>
                            <p class="text-2xl font-bold text-cyber-green">${{ number_format(session('user_balance', 0), 2) }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-cyber-blue to-cyber-purple p-0.5 rounded-full">
                            <div class="bg-dark-bg rounded-full px-4 py-2">
                                <span class="text-white font-semibold">{{ session('user_name', 'User') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-6 py-4 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
