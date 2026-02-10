@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-gray-400">Login to continue trading</p>
        </div>

        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Email or Username</label>
                    <input type="text" name="login" value="{{ old('login') }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required autofocus>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded bg-dark-bg border-gray-700 text-cyber-blue focus:ring-cyber-blue">
                        <span class="ml-2 text-gray-400 text-sm">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-cyber-blue text-sm hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyber-blue to-cyber-purple text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-300">Login</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400 text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-cyber-blue hover:underline font-semibold">Register here</a></p>
            </div>
        </div>

        <div class="mt-6 bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
            <p class="text-blue-400 text-sm font-semibold mb-2 text-center">🔑 Demo Credentials</p>
            <div class="text-gray-400 text-xs space-y-1">
                <p><strong>Email:</strong> demo@tradingplatform.com</p>
                <p><strong>Username:</strong> demotrader</p>
                <p><strong>Password:</strong> password</p>
            </div>
        </div>
    </div>
</div>
@endsection
