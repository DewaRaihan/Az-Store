<?php

namespace App\Services\CardStats;

use App\Models\CashFlow;
use App\Services\BaseDateRange;
use App\Services\Contracts\CardStatsInterface;
use Cache;
use Carbon\Carbon;
use Ramsey\Uuid\Type\Decimal;

class IncomeStats extends BaseDateRange implements CardStatsInterface
{
    public function calculate(string|null $filter = null): mixed
    {
        [$start, $end] = $this->resolveDateRange($filter);

        return CashFlow::where('type_trans', 'in')
                        ->whereBetween('created_at', [$start, $end])
                        ->sum('amount');
    }

    public function cacheKey(string|null $filter = null): string
    {
        return 'income_stats:' . ($filter ?? '');
    }

    public function handle(string|null $filter = null): mixed
    {
        $key = $this->cacheKey($filter);
        return Cache::remember($key, now()->addHours(3), fn() => $this->calculate($filter));
    }
}