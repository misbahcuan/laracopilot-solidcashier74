@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-white mb-2">Create Account</h2>
            <p class="text-gray-400">Join the future of trading</p>
        </div>

        <div class="bg-dark-card border border-cyber-blue/20 rounded-lg p-8">
            @if($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyber-blue to-cyber-purple text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-300">Create Account</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400 text-sm">Already have an account? <a href="{{ route('login') }}" class="text-cyber-blue hover:underline font-semibold">Login here</a></p>
            </div>
        </div>

        <div class="mt-6 bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4">
            <p class="text-yellow-500 text-sm text-center">⚠️ Test Environment - Registration creates demo account with simulated funds</p>
        </div>
    </div>
</div>
@endsection
