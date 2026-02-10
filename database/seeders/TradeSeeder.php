<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trade;
use App\Models\User;

class TradeSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $symbols = ['BTC/USD', 'ETH/USD', 'XAUT/USD', 'PAXG/USD'];
        $types = ['buy', 'sell'];
        $statuses = ['active', 'completed', 'cancelled'];

        foreach ($users as $user) {
            for ($i = 0; $i < rand(3, 8); $i++) {
                $amount = rand(100, 5000);
                $entryPrice = rand(1000, 70000);
                $profit = rand(-500, 1500);
                $status = $statuses[array_rand($statuses)];

                Trade::create([
                    'user_id' => $user->id,
                    'symbol' => $symbols[array_rand($symbols)],
                    'type' => $types[array_rand($types)],
                    'amount' => $amount,
                    'entry_price' => $entryPrice,
                    'exit_price' => $status === 'completed' ? $entryPrice + rand(-1000, 3000) : null,
                    'profit' => $status === 'completed' ? $profit : 0,
                    'status' => $status
                ]);
            }
        }
    }
}