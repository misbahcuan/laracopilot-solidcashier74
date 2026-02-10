<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Demo Trader',
            'username' => 'demotrader',
            'email' => 'demo@tradingplatform.com',
            'password' => Hash::make('password'),
            'balance' => 10000.00,
            'referral_code' => 'DEMO2024',
            'phone' => '+1234567890',
            'country' => 'United States'
        ]);

        User::create([
            'name' => 'John Investor',
            'username' => 'johninvestor',
            'email' => 'john@tradingplatform.com',
            'password' => Hash::make('password'),
            'balance' => 25000.00,
            'referral_code' => 'JOHN2024',
            'phone' => '+1987654321',
            'country' => 'United Kingdom'
        ]);

        User::factory()->count(18)->create();
    }
}