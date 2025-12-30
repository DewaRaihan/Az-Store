<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ResetDailyCache extends Command
{
    protected $signature = 'cache:reset-daily';
    protected $description = 'Reset income and other dashboard caches daily at 3 AM';

    public function handle()
    {
        Cache::forget('income_stats');
        Cache::forget('spending_stats');
        Cache::forget('profit_stats');

        $this->info('Daily caches have been cleared successfully.');
        \Log::info('Daily cache reset executed at ' . now());
    }
}
