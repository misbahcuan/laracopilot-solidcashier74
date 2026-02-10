<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        $recentDeposits = Deposit::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('deposit.index', compact('user', 'recentDeposits'));
    }

    public function store(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'amount' => 'required|numeric|min:10',
            'transaction_id' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $user = User::find(session('user_id'));

        Deposit::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending'
        ]);

        return redirect()->route('deposit.index')
            ->with('success', '✅ Deposit request submitted! Waiting for admin confirmation. This usually takes 10-30 minutes.');
    }

    public function history()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        $deposits = Deposit::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);

        return view('deposit.history', compact('user', 'deposits'));
    }
}