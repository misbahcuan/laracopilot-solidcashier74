<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Demo user
        User::create([
            'name' => 'Demo Trader',
            'email' => 'demo@tradingplatform.com',
            'username' => 'demotrader',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
            'country' => 'United States',
            'balance' => 5000.00,
            'referral_code' => 'DEMO1234',
            'nxt_tokens' => 50000,
            'email_verified_at' => now()
        ]);

        // Additional test users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'username' => 'user' . $i,
                'password' => Hash::make('password'),
                'phone' => '+123456789' . $i,
                'country' => 'United States',
                'balance' => rand(100, 10000),
                'referral_code' => strtoupper(Str::random(8)),
                'nxt_tokens' => rand(1000, 100000),
                'email_verified_at' => now()
            ]);
        }
    }
}