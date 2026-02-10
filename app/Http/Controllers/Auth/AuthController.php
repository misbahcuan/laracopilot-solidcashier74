<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (session('user_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'balance' => 0.00,
            'referral_code' => strtoupper(substr(md5(uniqid()), 0, 8))
        ]);

        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_username' => $user->username
        ]);

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to the platform.');
    }

    public function showLogin()
    {
        if (session('user_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $credentials['login'])
            ->orWhere('username', $credentials['login'])
            ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_username' => $user->username
            ]);

            return redirect()->route('dashboard')->with('success', 'Welcome back!');
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
        
        return back()->with('success', 'Password reset link sent to your email (Demo Mode).');
    }

    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name', 'user_email', 'user_username']);
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}