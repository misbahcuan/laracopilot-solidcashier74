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

        foreach ($users->take(5) as $referrer) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                $referred = $users->random();
                if ($referred->id !== $referrer->id) {
                    Referral::create([
                        'referrer_id' => $referrer->id,
                        'referred_id' => $referred->id,
                        'level' => rand(1, 7),
                        'commission' => rand(10, 500),
                        'status' => rand(0, 1) ? 'active' : 'inactive'
                    ]);
                }
            }
        }
    }
}