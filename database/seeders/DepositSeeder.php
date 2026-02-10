<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Support\Str;

class DepositSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $statuses = ['pending', 'completed', 'rejected'];

        foreach ($users as $user) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                Deposit::create([
                    'user_id' => $user->id,
                    'amount' => rand(50, 10000),
                    'payment_method' => 'USDT BEP-20',
                    'transaction_id' => '0x' . Str::random(64),
                    'status' => $statuses[array_rand($statuses)]
                ]);
            }
        }
    }
}