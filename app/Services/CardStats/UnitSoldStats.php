<?php

namespace App\Services\CardStats;

use App\Models\Transaction;
use App\Services\BaseDateRange;
use App\Services\Contracts\CardStatsInterface;
use Cache;

class UnitSoldStats extends BaseDateRange implements CardStatsInterface
{
    public function calculate(string|null $filter = null): mixed
    {
        [$start, $end] = $this->resolveDateRange($filter);

        return Transaction::whereNotNull('hp_out')->whereBetween('created_at', [$start, $end])->count();
    }

    public function cacheKey(string|null $filter = null): string
    {
        return 'unitSold_stats:' . ($filter ?? '');
    }

    public function handle(string|null $filter = null): mixed
    {
        $key = $this->cacheKey($filter);
        
        return Cache::remember($key, now()->addHours(3), fn() => $this->calculate($filter));
    }
}