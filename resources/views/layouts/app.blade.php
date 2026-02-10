<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trading Platform') - Future Trade</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            0%, 100% { text-shadow: 0 0 10px rgba(0, 240, 255, 0.5), 0 0 20px rgba(0, 240, 255, 0.3); }
            50% { text-shadow: 0 0 20px rgba(0, 240, 255, 0.8), 0 0 30px rgba(0, 240, 255, 0.5); }
        }
        @keyframes pulse-border {
            0%, 100% { border-color: rgba(0, 240, 255, 0.3); }
            50% { border-color: rgba(0, 240, 255, 0.8); }
        }
        .glow-text { animation: glow 2s ease-in-out infinite; }
        .pulse-border { animation: pulse-border 2s ease-in-out infinite; }
        .gradient-border {
            background: linear-gradient(145deg, #00f0ff, #b537f2);
            padding: 2px;
        }
    </style>
</head>
<body class="bg-dark-bg text-gray-100 min-h-screen">
    <nav class="bg-gradient-to-r from-dark-card to-dark-bg border-b border-cyber-blue/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold glow-text text-cyber-blue">⚡ FutureTrade</a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-cyber-blue transition-all duration-300">Home</a>
                    <a href="{{ route('home') }}#features" class="text-gray-300 hover:text-cyber-blue transition-all duration-300">Features</a>
                    <a href="{{ route('home') }}#about" class="text-gray-300 hover:text-cyber-blue transition-all duration-300">About</a>
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-cyber-blue to-cyber-purple text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 font-semibold">Login</a>
                    <a href="{{ route('register') }}" class="border-2 border-cyber-blue text-cyber-blue px-6 py-2 rounded-lg hover:bg-cyber-blue hover:text-white transition-all duration-300 font-semibold">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gradient-to-b from-dark-bg to-dark-card border-t border-cyber-blue/20 mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-cyber-blue mb-4">⚡ FutureTrade</h3>
                    <p class="text-gray-400 text-sm">Next-generation trading platform powered by AI and blockchain technology.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Platform</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Dashboard</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Trading</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Portfolio</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Analytics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Resources</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">API</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Support</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Status</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Risk Disclosure</a></li>
                        <li><a href="#" class="hover:text-cyber-blue transition-colors">Licenses</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>© {{ date('Y') }} FutureTrade. All rights reserved. <span class="text-yellow-500">⚠️ TEST ENVIRONMENT - SIMULATED TRADING ONLY</span></p>
                <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-cyber-blue hover:underline">LaraCopilot</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
