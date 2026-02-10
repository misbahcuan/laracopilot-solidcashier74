<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTrade - AI-Powered Investment Platform</title>
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
        body { background: linear-gradient(135deg, #0a0e27 0%, #1a1f4e 50%, #0a0e27 100%); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .gradient-text { background: linear-gradient(90deg, #00d4ff, #a855f7, #00ff88); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="text-gray-100">
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-dark-card/80 backdrop-blur-lg border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center text-xl sm:text-2xl">🚀</div>
                    <span class="text-lg sm:text-xl font-bold text-white">FutureTrade</span>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <a href="{{ route('login') }}" class="px-3 sm:px-4 py-2 text-sm sm:text-base text-gray-300 hover:text-white transition-all">Login</a>
                    <a href="{{ route('register') }}" class="px-3 sm:px-6 py-2 bg-gradient-to-r from-cyber-blue to-cyber-purple text-white rounded-lg hover:opacity-90 transition-all text-sm sm:text-base font-semibold">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 sm:pt-32 pb-12 sm:pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold text-white mb-4 sm:mb-6 leading-tight">
                        Trade Smarter with <span class="gradient-text">AI Technology</span>
                    </h1>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-400 mb-6 sm:mb-8 leading-relaxed">
                        Experience the future of trading with our AI-powered platform. Automated strategies, real-time analytics, and multi-level referral rewards.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-cyber-blue to-cyber-purple text-white rounded-lg hover:opacity-90 transition-all text-base sm:text-lg font-bold text-center">Get Started Free</a>
                        <a href="#features" class="px-6 sm:px-8 py-3 sm:py-4 border border-gray-700 text-white rounded-lg hover:bg-gray-800 transition-all text-base sm:text-lg font-bold text-center">Learn More</a>
                    </div>
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-12">
                        <div class="text-center">
                            <p class="text-2xl sm:text-3xl font-bold text-cyber-blue">10K+</p>
                            <p class="text-xs sm:text-sm text-gray-400 mt-1">Active Traders</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl sm:text-3xl font-bold text-cyber-green">$50M+</p>
                            <p class="text-xs sm:text-sm text-gray-400 mt-1">Trading Volume</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl sm:text-3xl font-bold text-cyber-purple">98%</p>
                            <p class="text-xs sm:text-sm text-gray-400 mt-1">Success Rate</p>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block animate-float">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 rounded-3xl blur-3xl"></div>
                        <div class="relative bg-dark-card border border-gray-800 rounded-3xl p-6 sm:p-8">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-500/10 to-transparent border border-green-500/30 rounded-xl">
                                    <div>
                                        <p class="text-gray-400 text-sm">BTC/USD</p>
                                        <p class="text-white font-bold text-xl">$64,250</p>
                                    </div>
                                    <span class="text-green-400 text-2xl">+2.45%</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-500/10 to-transparent border border-blue-500/30 rounded-xl">
                                    <div>
                                        <p class="text-gray-400 text-sm">ETH/USD</p>
                                        <p class="text-white font-bold text-xl">$3,450</p>
                                    </div>
                                    <span class="text-blue-400 text-2xl">+1.85%</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-yellow-500/10 to-transparent border border-yellow-500/30 rounded-xl">
                                    <div>
                                        <p class="text-gray-400 text-sm">GOLD/USD</p>
                                        <p class="text-white font-bold text-xl">$2,045</p>
                                    </div>
                                    <span class="text-yellow-400 text-2xl">+0.55%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-12 sm:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">Powerful Features</h2>
                <p class="text-base sm:text-lg text-gray-400">Everything you need to succeed in trading</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <div class="bg-dark-card border border-gray-800 rounded-xl p-6 sm:p-8 hover:border-cyber-blue transition-all">
                    <div class="text-4xl sm:text-5xl mb-4">🤖</div>
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">AI Trading</h3>
                    <p class="text-sm sm:text-base text-gray-400">Advanced AI algorithms optimize your trades 24/7 for maximum profits.</p>
                </div>
                <div class="bg-dark-card border border-gray-800 rounded-xl p-6 sm:p-8 hover:border-cyber-purple transition-all">
                    <div class="text-4xl sm:text-5xl mb-4">🔒</div>
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">Secure Platform</h3>
                    <p class="text-sm sm:text-base text-gray-400">Bank-level security with encrypted transactions and 2FA protection.</p>
                </div>
                <div class="bg-dark-card border border-gray-800 rounded-xl p-6 sm:p-8 hover:border-cyber-green transition-all">
                    <div class="text-4xl sm:text-5xl mb-4">👥</div>
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">7-Level Referral</h3>
                    <p class="text-sm sm:text-base text-gray-400">Earn up to 25% commission from your network across 7 levels.</p>
                </div>
                <div class="bg-dark-card border border-gray-800 rounded-xl p-6 sm:p-8 hover:border-cyber-blue transition-all">
                    <div class="text-4xl sm:text-5xl mb-4">💰</div>
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">Fast Deposits</h3>
                    <p class="text-sm sm:text-base text-gray-400">USDT BEP-20 deposits confirmed within 10-30 minutes.</p>
                </div>
                <div class="bg-dark-card border border-gray-800 rounded-xl p-6 sm:p-8 hover:border-cyber-purple transition-all">
                    <div class="text-4xl sm:text-5xl mb-4">🪙</div>
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">NXT Rewards</h3>
                    <p class="text-sm sm:text-base text-gray-400">Earn bonus NXT tokens with every deposit for future trading.</p>
                </div>
                <div class="bg-dark-card border border-gray-800 rounded-xl p-6 sm:p-8 hover:border-cyber-green transition-all">
                    <div class="text-4xl sm:text-5xl mb-4">📊</div>
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">Real-Time Analytics</h3>
                    <p class="text-sm sm:text-base text-gray-400">Track your portfolio performance with live charts and statistics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-gradient-to-r from-cyber-blue/10 to-cyber-purple/10 border border-cyber-blue/30 rounded-2xl p-8 sm:p-12">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6">Ready to Start Trading?</h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-400 mb-6 sm:mb-8">Join thousands of traders already profiting with AI-powered strategies</p>
                <a href="{{ route('register') }}" class="inline-block px-8 sm:px-12 py-3 sm:py-4 bg-gradient-to-r from-cyber-blue to-cyber-purple text-white rounded-lg hover:opacity-90 transition-all text-base sm:text-lg font-bold">Create Free Account →</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark-card border-t border-gray-800 py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center text-xl">🚀</div>
                        <span class="text-lg font-bold text-white">FutureTrade</span>
                    </div>
                    <p class="text-sm text-gray-400">AI-powered investment platform for the future of trading.</p>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-4">Platform</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyber-blue">Features</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Pricing</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Security</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">API</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-4">Company</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyber-blue">About</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Blog</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Careers</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-4">Legal</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyber-blue">Terms</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Privacy</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Cookies</a></li>
                        <li><a href="#" class="hover:text-cyber-blue">Licenses</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 sm:mt-12 pt-6 sm:pt-8 text-center">
                <p class="text-sm text-gray-500">© {{ date('Y') }} FutureTrade. All rights reserved.</p>
                <p class="text-sm text-gray-500 mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-cyber-blue hover:underline">LaraCopilot</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
