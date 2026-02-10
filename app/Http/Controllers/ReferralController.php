<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));

        $referralLink = url('/register?ref=' . $user->referral_code);
        $totalReferrals = Referral::where('referrer_id', $user->id)->count();
        $totalEarnings = Referral::where('referrer_id', $user->id)->sum('commission');
        $activeReferrals = Referral::where('referrer_id', $user->id)
                                ->where('status', 'active')
                                ->count();

        $referrals = Referral::where('referrer_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->take(20)
                            ->get();

        return view('referral.index', compact(
            'user', 'referralLink', 'totalReferrals', 'totalEarnings',
            'activeReferrals', 'referrals'
        ));
    }

    public function generate(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $user = User::find(session('user_id'));
        $referralLink = url('/register?ref=' . $user->referral_code);

        return response()->json(['link' => $referralLink]);
    }
}