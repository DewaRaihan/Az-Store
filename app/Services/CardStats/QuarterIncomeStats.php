<?php

namespace App\Services\CardStats;

use App\Models\CashFlow;
use App\Services\BaseDateRange;
use App\Services\Contracts\CardStatsInterface;
use Illuminate\Support\Facades\Cache;

class QuarterIncomeStats extends BaseDateRange implements CardStatsInterface
{
    public function calculate(string|null $filter = null): mixed
    {
        $filter = 'quarter';
        [$start, $end] = $this->resolveDateRange($filter);
        //dd($start, $end);

        return CashFlow::where('type_trans', 'in')
                        ->whereBetween('created_at', [$start, $end])
                        ->sum('amount');
    }

    public function cacheKey(string|null $filter = null): string
    {
        return 'quarterIncome_stats:' . ($filter ?? '');
    }

    public function handle(string|null $filter = null): mixed
    {
        $key = $this->cacheKey($filter);
        return Cache::remember($key, now()->addHours(3), fn() => $this->calculate($filter));
    }
}