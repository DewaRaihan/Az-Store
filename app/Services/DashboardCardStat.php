<?php
/*
namespace App\Services;

use App\Models\CashFlow;
use Carbon\Carbon;

class DashboardCardStat
{
    public function handle()
    {
        $result = $this->cardFinance();
        return $result;
    }
    public function cardFinance()
    {
        $start = Carbon::today()->subHours(3);
        $end = Carbon::tomorrow()->subHours(3);

        $columnDate = 'created_at';

        $income = CashFlow::where('type_trans', 'in')
            ->whereBetween($columnDate, [$start, $end])
            ->sum('amount');

        $success = cache()->put('income_stats', $income);

        \Log::info('DashboardCardStat handled at ' . now(), [
            'income' => $income,
            'cache_saved' => $success,
            'cache_driver' => config('cache.default'),
        ]);

        return [
            'income' => $income,
        ];
    }
}