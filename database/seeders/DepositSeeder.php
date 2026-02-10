<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deposit;
use App\Models\User;

class DepositSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $methods = ['Bitcoin (BTC)', 'Ethereum (ETH)', 'USDT (TRC20)', 'Bank Transfer', 'Credit Card'];
        $statuses = ['completed', 'pending', 'failed'];

        foreach ($users as $user) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                Deposit::create([
                    'user_id' => $user->id,
                    'amount' => rand(100, 10000),
                    'payment_method' => $methods[array_rand($methods)],
                    'transaction_id' => 'TXN' . strtoupper(substr(md5(uniqid()), 0, 12)),
                    'status' => $statuses[array_rand($statuses)]
                ]);
            }
        }
    }
}