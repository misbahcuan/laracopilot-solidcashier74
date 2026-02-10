<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trade;
use App\Models\User;
use Carbon\Carbon;

class CompleteTrades extends Command
{
    protected $signature = 'trades:complete';
    protected $description = 'Complete trades that are 24+ hours old and calculate profits';

    public function handle()
    {
        $this->info('Starting trade completion process...');

        $trades = Trade::where('status', 'active')
                      ->where('created_at', '<=', Carbon::now()->subHours(24))
                      ->get();

        $this->info("Found {$trades->count()} trades to complete");

        foreach ($trades as $trade) {
            try {
                $currentPrice = $this->fetchCurrentPrice($trade->symbol);
                
                if ($currentPrice <= 0) {
                    $this->warn("Could not fetch price for {$trade->symbol}, skipping trade #{$trade->id}");
                    continue;
                }

                $priceChange = (($currentPrice - $trade->entry_price) / $trade->entry_price) * 100;
                $strategyMultiplier = $this->getStrategyMultiplier($trade->strategy ?? 'manual');
                $profit = ($trade->amount * $priceChange / 100) * $strategyMultiplier;
                
                $trade->exit_price = $currentPrice;
                $trade->profit = $profit;
                $trade->status = 'completed';
                $trade->save();

                $user = User::find($trade->user_id);
                if ($user) {
                    $user->balance += ($trade->amount + $profit);
                    $user->save();
                    
                    $this->info("Trade #{$trade->id} completed. Profit: $" . number_format($profit, 2));
                }
            } catch (\Exception $e) {
                $this->error("Error completing trade #{$trade->id}: " . $e->getMessage());
            }
        }

        $this->info('Trade completion process finished!');
        return 0;
    }

    private function fetchCurrentPrice($symbol)
    {
        $symbolMap = [
            'BTC/USD' => 'bitcoin',
            'ETH/USD' => 'ethereum',
            'XAUT/USD' => 'tether-gold',
            'PAXG/USD' => 'pax-gold'
        ];

        $coinId = $symbolMap[$symbol] ?? 'bitcoin';

        try {
            $response = file_get_contents(
                "https://api.coingecko.com/api/v3/simple/price?ids={$coinId}&vs_currencies=usd"
            );
            $data = json_decode($response, true);
            return $data[$coinId]['usd'] ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getStrategyMultiplier($strategy)
    {
        $multipliers = [
            'arbitrage' => 1.1,
            'ai-trading' => 1.15,
            'dca' => 1.08,
            'manual' => 1.0
        ];

        return $multipliers[$strategy] ?? 1.0;
    }
}