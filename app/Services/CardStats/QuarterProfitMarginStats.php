<?php

namespace App\Services\CardStats;

use App\Models\CashFlow;
use App\Services\BaseDateRange;
use App\Services\Contracts\CardStatsInterface;
use Cache;


class QuarterProfitMarginStats extends BaseDateRange implements CardStatsInterface
{
    public function calculate(string|null $filter = null): float|int
    {
        [$start, $end] = $this->resolveDateRange('quarter');

        $income = CashFlow::where('type_trans', 'in')
                            ->whereBetween('created_at', [$start, $end])
                            ->sum('amount');

        $spending = CashFlow::where('type_trans', 'out')
                            ->whereBetween('created_at', [$start, $end])
                            ->sum('amount');
                            
        $netProfit = $income - $spending;

        $result = $income > 0 ? ($netProfit / $income) * 100 : 0;

        return $result;
    }

    public function cacheKey(string|null $filter = null): string
    {
        return 'quarterProfitMargin_stats:' . ($filter ?? '');
    }

    public function handle(string|null $filter = null): mixed
    {
        $key = $this->cacheKey($filter);
        return Cache::remember($key, now()->addHours(3), fn() => $this->calculate($filter));
    }
}