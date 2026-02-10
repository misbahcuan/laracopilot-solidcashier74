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
        $symbols = ['BTC/USD', 'ETH/USD', 'XAUT/USD', 'PAXG/USD', 'BNB/USD', 'SOL/USD'];
        $types = ['buy', 'sell'];
        $statuses = ['active', 'completed', 'cancelled'];

        foreach ($users as $user) {
            for ($i = 0; $i < rand(3, 8); $i++) {
                $entryPrice = rand(100, 65000);
                $currentPrice = $entryPrice + rand(-1000, 1000);
                $amount = rand(100, 5000);
                $profit = ($currentPrice - $entryPrice) * ($amount / $entryPrice);

                Trade::create([
                    'user_id' => $user->id,
                    'symbol' => $symbols[array_rand($symbols)],
                    'type' => $types[array_rand($types)],
                    'amount' => $amount,
                    'entry_price' => $entryPrice,
                    'current_price' => $currentPrice,
                    'profit' => $profit,
                    'status' => $statuses[array_rand($statuses)]
                ]);
            }
        }
    }
}