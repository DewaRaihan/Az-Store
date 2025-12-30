<?php

namespace App\Services\CardStats;

use App\Models\CashFlow;
use App\Services\BaseDateRange;
use App\Services\Contracts\CardStatsInterface;
use Cache;
use Carbon\Carbon;
use Ramsey\Uuid\Type\Decimal;

class TotalIncomeStats extends BaseDateRange implements CardStatsInterface
{
    public function calculate(string|null $filter = null): mixed
    {
        //[$start, $end] = $this->resolveDateRange($filter);

        return CashFlow::where('type_trans', 'in')
                        ->sum('amount');
    }

    public function cacheKey(string|null $filter = null): string
    {
        return 'totalIncome_stats:' . ($filter ?? '');
    }

    public function handle(string|null $filter = null): mixed
    {
        $key = $this->cacheKey($filter);
        return Cache::remember($key, now()->addHours(3), fn() => $this->calculate($filter));
    }
}