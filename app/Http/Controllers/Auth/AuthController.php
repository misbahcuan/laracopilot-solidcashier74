<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (session('user_id')) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:50',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $referralCode = strtoupper(Str::random(8));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'referral_code' => $referralCode,
            'balance' => 0,
            'nxt_tokens' => 0
        ]);

        // Auto login after registration
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_balance' => $user->balance,
            'logged_in' => true
        ]);

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to FutureTrade.');
    }

    public function showLogin()
    {
        if (session('user_id')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

        // Try to find user by email or username
        $user = User::where('email', $request->login)
                    ->orWhere('username', $request->login)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_balance' => $user->balance,
                'logged_in' => true
            ]);

            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors(['login' => 'Invalid credentials. Please try again.'])->withInput();
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return back()->with('success', 'Password reset link has been sent to your email (Demo: Check your email)');
        }

        return back()->withErrors(['email' => 'Email not found in our records.']);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}