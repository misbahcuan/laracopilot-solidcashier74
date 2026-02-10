<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);

        $recentWithdrawals = Withdrawal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $withdrawalMethods = [
            ['type' => 'crypto', 'name' => 'Bitcoin (BTC)', 'icon' => '₿', 'fee' => '0.5%'],
            ['type' => 'crypto', 'name' => 'Ethereum (ETH)', 'icon' => 'Ξ', 'fee' => '0.5%'],
            ['type' => 'crypto', 'name' => 'USDT (TRC20)', 'icon' => '₮', 'fee' => '0.3%'],
            ['type' => 'bank', 'name' => 'Bank Transfer', 'icon' => '🏦', 'fee' => '1.0%']
        ];

        return view('withdrawal.index', compact('user', 'recentWithdrawals', 'withdrawalMethods'));
    }

    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:10',
            'withdrawal_method' => 'required|string',
            'wallet_address' => 'required|string'
        ]);

        $userId = session('user_id');
        $user = User::find($userId);

        if ($user->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Insufficient balance for withdrawal.']);
        }

        Withdrawal::create([
            'user_id' => $userId,
            'amount' => $validated['amount'],
            'withdrawal_method' => $validated['withdrawal_method'],
            'wallet_address' => $validated['wallet_address'],
            'transaction_id' => 'WTH' . strtoupper(substr(md5(uniqid()), 0, 12)),
            'status' => 'pending'
        ]);

        $user->balance -= $validated['amount'];
        $user->save();

        return redirect()->route('withdrawal.index')->with('success', 'Withdrawal request of $' . number_format($validated['amount'], 2) . ' submitted successfully!');
    }

    public function history()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $withdrawals = Withdrawal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('withdrawal.history', compact('withdrawals'));
    }
}