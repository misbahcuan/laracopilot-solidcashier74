<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . session('user_id'),
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100'
        ]);

        $user = User::find(session('user_id'));
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country
        ]);

        session(['user_name' => $user->name, 'user_email' => $user->email]);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::find(session('user_id'));

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password changed successfully!');
    }
}