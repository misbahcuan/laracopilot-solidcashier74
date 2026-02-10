<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);

        $recentDeposits = Deposit::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $paymentMethods = [
            ['type' => 'crypto', 'name' => 'Bitcoin (BTC)', 'icon' => '₿', 'network' => 'Bitcoin Network'],
            ['type' => 'crypto', 'name' => 'Ethereum (ETH)', 'icon' => 'Ξ', 'network' => 'Ethereum Network'],
            ['type' => 'crypto', 'name' => 'USDT (TRC20)', 'icon' => '₮', 'network' => 'Tron Network'],
            ['type' => 'bank', 'name' => 'Bank Transfer', 'icon' => '🏦', 'network' => 'Wire Transfer'],
            ['type' => 'card', 'name' => 'Credit/Debit Card', 'icon' => '💳', 'network' => 'Visa/Mastercard']
        ];

        return view('deposit.index', compact('user', 'recentDeposits', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:10',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string'
        ]);

        $userId = session('user_id');

        $deposit = Deposit::create([
            'user_id' => $userId,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'] ?? 'TXN' . strtoupper(substr(md5(uniqid()), 0, 12)),
            'status' => 'pending'
        ]);

        // Auto-approve for demo (in production, this would be manual)
        $deposit->status = 'completed';
        $deposit->save();

        $user = User::find($userId);
        $user->balance += $validated['amount'];
        $user->save();

        return redirect()->route('deposit.index')->with('success', 'Deposit of $' . number_format($validated['amount'], 2) . ' completed successfully!');
    }

    public function history()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $deposits = Deposit::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('deposit.history', compact('deposits'));
    }
}