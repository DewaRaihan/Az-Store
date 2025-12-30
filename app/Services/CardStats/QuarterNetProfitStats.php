<?php

namespace App\Services\CardStats;

use App\Models\CashFlow;
use App\Services\BaseDateRange;
use App\Services\Contracts\CardStatsInterface;
use Cache;


class QuarterNetProfitStats extends BaseDateRange implements CardStatsInterface
{
    public function calculate(string|null $filter = null): float|int
    {
        $filter = 'quarter';
        [$start, $end] = $this->resolveDateRange($filter);

        $income = CashFlow::where('type_trans', 'in')
                            ->whereBetween('created_at', [$start, $end])
                            ->sum('amount');

        $spending = CashFlow::where('type_trans', 'out')
                            ->whereBetween('created_at', [$start, $end])
                            ->sum('amount');
                            
        $result = $income - $spending;
        
        return $result;
    }

    public function cacheKey(string|null $filter = null): string
    {
        return 'quarterNetProfit_stats:' . ($filter ?? '');
    }

    public function handle(string|null $filter = null): mixed
    {
        $key = $this->cacheKey($filter);
        return Cache::remember($key, now()->addHours(3), fn() => $this->calculate($filter));
    }
}