<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Referral;
use App\Models\User;

class ReferralSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        for ($i = 0; $i < 15; $i++) {
            $referrer = $users->random();
            $referred = $users->where('id', '!=', $referrer->id)->random();

            if (!Referral::where('referrer_id', $referrer->id)->where('referred_id', $referred->id)->exists()) {
                Referral::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $referred->id,
                    'commission' => rand(10, 500),
                    'status' => rand(0, 1) ? 'active' : 'inactive'
                ]);
            }
        }
    }
}