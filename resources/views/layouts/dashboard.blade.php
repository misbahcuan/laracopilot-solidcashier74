<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - FutureTrade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#0a0e27',
                        'dark-card': '#0f1535',
                        'cyber-blue': '#00d4ff',
                        'cyber-purple': '#a855f7',
                        'cyber-green': '#00ff88'
                    }
                }
            }
        }
    </script>
    <style>
        body { background: linear-gradient(135deg, #0a0e27 0%, #1a1f4e 50%, #0a0e27 100%); min-height: 100vh; }
        .status-trading { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
        .gradient-border { border-image: linear-gradient(90deg, #00d4ff, #a855f7, #00ff88) 1; }
        /* Mobile Bottom Nav */
        .mobile-nav { transform: translateY(0); transition: transform 0.3s ease; }
        .mobile-nav.hidden-nav { transform: translateY(100%); }
        /* Hide scrollbar but keep functionality */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="text-gray-100">
    <!-- Desktop Sidebar (Hidden on Mobile) -->
    <div class="hidden lg:block fixed left-0 top-0 h-screen w-64 bg-dark-card border-r border-gray-800 z-40">
        <div class="p-6">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center text-2xl">🚀</div>
                <span class="text-xl font-bold text-white">FutureTrade</span>
            </a>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">📊</span>
                    <span class="font-semibold">Dashboard</span>
                </a>
                <a href="{{ route('trading.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('trading.*') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">⚡</span>
                    <span class="font-semibold">Trading</span>
                </a>
                <a href="{{ route('portfolio.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('portfolio.*') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">💼</span>
                    <span class="font-semibold">Portfolio</span>
                </a>
                <a href="{{ route('deposit.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('deposit.*') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">💳</span>
                    <span class="font-semibold">Deposit</span>
                </a>
                <a href="{{ route('withdrawal.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('withdrawal.*') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">💸</span>
                    <span class="font-semibold">Withdrawal</span>
                </a>
                <a href="{{ route('referral.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('referral.*') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">👥</span>
                    <span class="font-semibold">Referral</span>
                </a>
                <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 text-cyber-blue border border-cyber-blue/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">
                    <span class="text-xl">👤</span>
                    <span class="font-semibold">Profile</span>
                </a>
            </nav>
        </div>

        <div class="absolute bottom-6 left-6 right-6">
            <div class="bg-gradient-to-r from-cyber-purple/10 to-cyber-blue/10 border border-cyber-purple/30 rounded-lg p-4 mb-4">
                <p class="text-xs text-gray-400 mb-2">Account Balance</p>
                <p class="text-2xl font-bold text-cyber-green">${{ number_format(session('user_balance', 0), 2) }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-all">
                    <span>🚪</span>
                    <span class="font-semibold">Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Top Header -->
    <div class="lg:hidden fixed top-0 left-0 right-0 bg-dark-card border-b border-gray-800 z-50">
        <div class="flex items-center justify-between px-4 py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-br from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center text-lg">🚀</div>
                <span class="text-lg font-bold text-white">FutureTrade</span>
            </a>
            <div class="text-right">
                <p class="text-xs text-gray-400">Balance</p>
                <p class="text-lg font-bold text-cyber-green">${{ number_format(session('user_balance', 0), 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Page Header (Hidden on Mobile) -->
        <div class="hidden lg:block bg-dark-card border-b border-gray-800 px-6 lg:px-8 py-4 lg:py-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-white">@yield('page-title')</h1>
                    <p class="text-sm lg:text-base text-gray-400 mt-1">@yield('page-subtitle')</p>
                </div>
                <div class="mt-4 lg:mt-0">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Welcome back,</p>
                        <p class="text-lg font-bold text-white">{{ session('user_name') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area with Mobile Padding -->
        <div class="px-4 lg:px-8 py-6 lg:py-8 pb-24 lg:pb-8 mt-16 lg:mt-0 hide-scrollbar" style="max-height: calc(100vh - 64px); overflow-y: auto;">
            @if(session('success'))
                <div class="mb-4 lg:mb-6 bg-green-500/10 border border-green-500 text-green-400 px-4 lg:px-6 py-3 lg:py-4 rounded-lg text-sm lg:text-base">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 lg:mb-6 bg-red-500/10 border border-red-500 text-red-400 px-4 lg:px-6 py-3 lg:py-4 rounded-lg text-sm lg:text-base">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Mobile Bottom Navigation (5 Menu) -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-dark-card border-t border-gray-800 mobile-nav z-50">
        <div class="grid grid-cols-5 gap-0">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center py-3 {{ request()->routeIs('dashboard') ? 'text-cyber-blue' : 'text-gray-400' }} transition-all">
                <span class="text-2xl mb-1">📊</span>
                <span class="text-xs font-semibold">Home</span>
            </a>
            <a href="{{ route('trading.index') }}" class="flex flex-col items-center justify-center py-3 {{ request()->routeIs('trading.*') ? 'text-cyber-blue' : 'text-gray-400' }} transition-all">
                <span class="text-2xl mb-1">⚡</span>
                <span class="text-xs font-semibold">Trade</span>
            </a>
            <a href="{{ route('deposit.index') }}" class="flex flex-col items-center justify-center py-3 {{ request()->routeIs('deposit.*') ? 'text-cyber-blue' : 'text-gray-400' }} transition-all">
                <span class="text-2xl mb-1">💳</span>
                <span class="text-xs font-semibold">Deposit</span>
            </a>
            <a href="{{ route('referral.index') }}" class="flex flex-col items-center justify-center py-3 {{ request()->routeIs('referral.*') ? 'text-cyber-blue' : 'text-gray-400' }} transition-all">
                <span class="text-2xl mb-1">👥</span>
                <span class="text-xs font-semibold">Referral</span>
            </a>
            <a href="{{ route('profile.index') }}" class="flex flex-col items-center justify-center py-3 {{ request()->routeIs('profile.*') ? 'text-cyber-blue' : 'text-gray-400' }} transition-all">
                <span class="text-2xl mb-1">👤</span>
                <span class="text-xs font-semibold">Profile</span>
            </a>
        </div>
    </div>
</body>
</html>
