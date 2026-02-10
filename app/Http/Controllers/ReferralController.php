<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);

        $referrals = Referral::where('referrer_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalReferrals = $referrals->count();
        $totalEarnings = $referrals->sum('commission');
        $activeReferrals = $referrals->where('status', 'active')->count();

        $referralLink = url('/register?ref=' . $user->referral_code);

        return view('referral.index', compact(
            'user', 'referrals', 'totalReferrals', 'totalEarnings',
            'activeReferrals', 'referralLink'
        ));
    }

    public function generate()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        return redirect()->route('referral.index')->with('success', 'Referral link generated successfully!');
    }
}