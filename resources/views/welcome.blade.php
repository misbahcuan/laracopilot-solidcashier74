@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-cyber-blue/10 via-transparent to-cyber-purple/10"></div>
    <div class="max-w-7xl mx-auto px-4 py-20 relative">
        <div class="text-center">
            <h1 class="text-6xl font-bold mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyber-blue via-cyber-purple to-cyber-green">Next-Gen Trading</span>
                <br>
                <span class="glow-text text-white">Powered by AI & Blockchain</span>
            </h1>
            <p class="text-xl text-gray-400 mb-8 max-w-3xl mx-auto">Experience the future of trading with AI-powered strategies, real-time arbitrage, and automated DCA systems across Crypto, XAUT, and PAXG markets.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-cyber-blue to-cyber-purple text-white px-8 py-4 rounded-lg text-lg font-bold hover:opacity-90 transition-all duration-300 transform hover:scale-105">Start Trading Now</a>
                <a href="#features" class="border-2 border-cyber-blue text-cyber-blue px-8 py-4 rounded-lg text-lg font-bold hover:bg-cyber-blue hover:text-white transition-all duration-300">Learn More</a>
            </div>
            <div class="mt-12 grid grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="bg-dark-card border border-cyber-blue/30 rounded-lg p-6">
                    <div class="text-3xl font-bold text-cyber-blue mb-2">$2.5B+</div>
                    <div class="text-gray-400">Trading Volume</div>
                </div>
                <div class="bg-dark-card border border-cyber-purple/30 rounded-lg p-6">
                    <div class="text-3xl font-bold text-cyber-purple mb-2">50K+</div>
                    <div class="text-gray-400">Active Traders</div>
                </div>
                <div class="bg-dark-card border border-cyber-green/30 rounded-lg p-6">
                    <div class="text-3xl font-bold text-cyber-green mb-2">99.9%</div>
                    <div class="text-gray-400">Uptime</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-gradient-to-b from-dark-bg to-dark-card">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white mb-4">Advanced Trading Features</h2>
            <p class="text-gray-400 text-lg">Cutting-edge technology for maximum returns</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-8 hover:border-cyber-blue transition-all duration-300 glow-card">
                <div class="text-4xl mb-4">🤖</div>
                <h3 class="text-2xl font-bold text-cyber-blue mb-4">AI-Powered Trading</h3>
                <p class="text-gray-400">Advanced algorithms analyze market patterns 24/7, executing optimal trades automatically to maximize your profits.</p>
            </div>
            <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-8 hover:border-cyber-purple transition-all duration-300 glow-card">
                <div class="text-4xl mb-4">⚡</div>
                <h3 class="text-2xl font-bold text-cyber-purple mb-4">Arbitrage Trading</h3>
                <p class="text-gray-400">Exploit price differences across exchanges instantly with our high-speed arbitrage engine.</p>
            </div>
            <div class="bg-dark-card border border-cyber-green/20 rounded-lg p-8 hover:border-cyber-green transition-all duration-300 glow-card">
                <div class="text-4xl mb-4">📈</div>
                <h3 class="text-2xl font-bold text-cyber-green mb-4">DCA Strategy</h3>
                <p class="text-gray-400">Automated Dollar Cost Averaging reduces risk and optimizes entry points across volatile markets.</p>
            </div>
            <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-8 hover:border-cyber-blue transition-all duration-300">
                <div class="text-4xl mb-4">🥇</div>
                <h3 class="text-2xl font-bold text-white mb-4">Gold-Backed Assets</h3>
                <p class="text-gray-400">Trade XAUT and PAXG - digital gold tokens backed by physical gold reserves.</p>
            </div>
            <div class="bg-dark-card border border-cyber-purple/20 rounded-lg p-8 hover:border-cyber-purple transition-all duration-300">
                <div class="text-4xl mb-4">🔒</div>
                <h3 class="text-2xl font-bold text-white mb-4">Secure & Compliant</h3>
                <p class="text-gray-400">Bank-grade security with multi-layer encryption and regulatory compliance.</p>
            </div>
            <div class="bg-dark-card border border-cyber-green/20 rounded-lg p-8 hover:border-cyber-green transition-all duration-300">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="text-2xl font-bold text-white mb-4">Real-Time Analytics</h3>
                <p class="text-gray-400">Live charts, performance tracking, and comprehensive portfolio insights.</p>
            </div>
        </div>
    </div>
</section>

<!-- Markets Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white mb-4">Supported Markets</h2>
            <p class="text-gray-400 text-lg">Trade across multiple asset classes</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-orange-500/10 to-orange-600/10 border border-orange-500/30 rounded-lg p-6">
                <div class="text-3xl mb-2">₿</div>
                <h4 class="text-xl font-bold text-white mb-2">Bitcoin</h4>
                <p class="text-2xl font-bold text-cyber-green">$64,250.50</p>
                <p class="text-sm text-green-400">+2.45%</p>
            </div>
            <div class="bg-gradient-to-br from-blue-500/10 to-purple-600/10 border border-blue-500/30 rounded-lg p-6">
                <div class="text-3xl mb-2">Ξ</div>
                <h4 class="text-xl font-bold text-white mb-2">Ethereum</h4>
                <p class="text-2xl font-bold text-cyber-green">$3,450.25</p>
                <p class="text-sm text-green-400">+1.85%</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-500/10 to-yellow-600/10 border border-yellow-500/30 rounded-lg p-6">
                <div class="text-3xl mb-2">🥇</div>
                <h4 class="text-xl font-bold text-white mb-2">Tether Gold</h4>
                <p class="text-2xl font-bold text-cyber-green">$2,045.75</p>
                <p class="text-sm text-green-400">+0.55%</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-400/10 to-orange-500/10 border border-yellow-400/30 rounded-lg p-6">
                <div class="text-3xl mb-2">🏆</div>
                <h4 class="text-xl font-bold text-white mb-2">Pax Gold</h4>
                <p class="text-2xl font-bold text-cyber-green">$2,046.20</p>
                <p class="text-sm text-green-400">+0.58%</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-gradient-to-b from-dark-card to-dark-bg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-white mb-6">Why Choose FutureTrade?</h2>
                <p class="text-gray-400 mb-6">We combine cutting-edge technology with traditional financial expertise to create the most advanced trading platform available. Our AI-driven strategies have consistently outperformed the market, delivering superior returns for our users.</p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="text-cyber-blue text-xl">✓</div>
                        <div>
                            <h4 class="font-bold text-white">Tested & Proven</h4>
                            <p class="text-gray-400 text-sm">24-hour lock period ensures optimal strategy execution</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="text-cyber-green text-xl">✓</div>
                        <div>
                            <h4 class="font-bold text-white">Transparent Operations</h4>
                            <p class="text-gray-400 text-sm">Real-time tracking of all trading activities</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="text-cyber-purple text-xl">✓</div>
                        <div>
                            <h4 class="font-bold text-white">24/7 Support</h4>
                            <p class="text-gray-400 text-sm">Expert assistance whenever you need it</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-8">
                <h3 class="text-2xl font-bold text-white mb-6">⚠️ Test Environment Notice</h3>
                <div class="space-y-4 text-gray-400">
                    <p>This platform operates in a <span class="text-yellow-500 font-bold">controlled test environment</span> for demonstration purposes.</p>
                    <ul class="list-disc list-inside space-y-2 text-sm">
                        <li>All trading data is simulated</li>
                        <li>No real funds are at risk</li>
                        <li>Perfect for learning and strategy testing</li>
                        <li>Full feature access without financial risk</li>
                    </ul>
                    <p class="text-xs text-gray-500 mt-4">By using this platform, you acknowledge this is a demo/test environment for educational purposes only.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="bg-gradient-to-r from-cyber-blue to-cyber-purple p-1 rounded-2xl">
            <div class="bg-dark-card rounded-2xl p-12">
                <h2 class="text-4xl font-bold text-white mb-4">Ready to Start Trading?</h2>
                <p class="text-gray-400 mb-8 text-lg">Join thousands of traders already profiting from our AI-powered platform</p>
                <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-cyber-blue to-cyber-purple text-white px-12 py-4 rounded-lg text-lg font-bold hover:opacity-90 transition-all duration-300 transform hover:scale-105">Create Free Account</a>
            </div>
        </div>
    </div>
</section>
@endsection
