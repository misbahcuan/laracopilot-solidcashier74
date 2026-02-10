<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Trade;
use App\Models\Referral;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $totalUsers = User::count();
        $totalDeposits = Deposit::sum('amount');
        $totalWithdrawals = Withdrawal::sum('amount');
        $activeTrades = Trade::where('status', 'active')->count();
        $pendingDeposits = Deposit::where('status', 'pending')->count();
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
        $totalReferrals = Referral::count();
        $totalCommissions = Referral::sum('commission');

        $recentUsers = User::orderBy('created_at', 'desc')->take(10)->get();
        $recentDeposits = Deposit::orderBy('created_at', 'desc')->take(10)->get();
        $recentWithdrawals = Withdrawal::orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalDeposits', 'totalWithdrawals', 'activeTrades',
            'pendingDeposits', 'pendingWithdrawals', 'totalReferrals', 'totalCommissions',
            'recentUsers', 'recentDeposits', 'recentWithdrawals'
        ));
    }

    public function users()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function deposits()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $deposits = Deposit::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.deposits', compact('deposits'));
    }

    public function approveDeposit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $deposit = Deposit::findOrFail($id);
        $deposit->status = 'completed';
        $deposit->save();

        $user = User::find($deposit->user_id);
        $user->balance += $deposit->amount;
        
        // Calculate NXT tokens based on deposit amount
        $nxtRewards = [
            10 => 1000,
            50 => 5000,
            100 => 10000,
            1000 => 100000,
            5000 => 500000,
            10000 => 1000000
        ];
        
        $nxtAmount = 0;
        foreach ($nxtRewards as $threshold => $tokens) {
            if ($deposit->amount >= $threshold) {
                $nxtAmount = $tokens;
            }
        }
        
        $user->nxt_tokens = ($user->nxt_tokens ?? 0) + $nxtAmount;
        $user->save();

        return back()->with('success', 'Deposit approved and balance credited!');
    }

    public function withdrawals()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $withdrawals = Withdrawal::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approveWithdrawal($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'completed';
        $withdrawal->save();

        return back()->with('success', 'Withdrawal approved!');
    }

    public function rejectWithdrawal($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'rejected';
        $withdrawal->save();

        $user = User::find($withdrawal->user_id);
        $user->balance += $withdrawal->amount;
        $user->save();

        return back()->with('success', 'Withdrawal rejected and balance refunded!');
    }
}