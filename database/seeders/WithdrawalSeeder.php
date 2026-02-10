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
        $methods = ['Bitcoin (BTC)', 'Ethereum (ETH)', 'USDT (TRC20)', 'Bank Transfer'];
        $statuses = ['pending', 'completed', 'rejected'];

        foreach ($users->take(10) as $user) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                Withdrawal::create([
                    'user_id' => $user->id,
                    'amount' => rand(50, 5000),
                    'withdrawal_method' => $methods[array_rand($methods)],
                    'wallet_address' => '0x' . strtoupper(substr(md5(uniqid()), 0, 40)),
                    'transaction_id' => 'WTH' . strtoupper(substr(md5(uniqid()), 0, 12)),
                    'status' => $statuses[array_rand($statuses)]
                ]);
            }
        }
    }
}