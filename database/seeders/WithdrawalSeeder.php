<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Withdrawal;
use App\Models\User;

class WithdrawalSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $statuses = ['pending', 'completed', 'rejected'];

        foreach ($users as $user) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                Withdrawal::create([
                    'user_id' => $user->id,
                    'amount' => rand(50, 5000),
                    'withdrawal_method' => 'USDT BEP-20',
                    'wallet_address' => '0x' . bin2hex(random_bytes(20)),
                    'status' => $statuses[array_rand($statuses)]
                ]);
            }
        }
    }
}