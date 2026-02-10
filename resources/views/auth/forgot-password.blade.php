@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-white mb-2">Reset Password</h2>
            <p class="text-gray-400">Enter your email to receive reset link</p>
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

            <form action="{{ route('password.request') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-400 text-sm font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-dark-bg border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-cyber-blue focus:outline-none transition-colors" required autofocus>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyber-blue to-cyber-purple text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-300">Send Reset Link</button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-cyber-blue text-sm hover:underline">← Back to Login</a>
            </div>
        </div>

        <div class="mt-6 bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4">
            <p class="text-yellow-500 text-sm text-center">⚠️ Demo Mode - Password reset functionality simulated</p>
        </div>
    </div>
</div>
@endsection
