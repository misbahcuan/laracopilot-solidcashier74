<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        $recentWithdrawals = Withdrawal::where('user_id', $user->id)
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();

        $withdrawalMethods = [
            ['name' => 'USDT BEP-20', 'icon' => '💰', 'fee' => '10%']
        ];

        return view('withdrawal.index', compact('user', 'recentWithdrawals', 'withdrawalMethods'));
    }

    public function store(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'amount' => 'required|numeric|min:20',
            'wallet_address' => 'required|string',
            'withdrawal_method' => 'required|string'
        ]);

        $user = User::find(session('user_id'));

        if ($user->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient balance.']);
        }

        // Deduct balance immediately
        $user->balance -= $request->amount;
        $user->save();
        session(['user_balance' => $user->balance]);

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'withdrawal_method' => $request->withdrawal_method,
            'wallet_address' => $request->wallet_address,
            'status' => 'pending'
        ]);

        return redirect()->route('withdrawal.index')
            ->with('success', '✅ Withdrawal request submitted! Admin will process within 24-48 hours.');
    }

    public function history()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        $withdrawals = Withdrawal::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(20);

        return view('withdrawal.history', compact('user', 'withdrawals'));
    }
}