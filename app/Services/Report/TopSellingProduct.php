<?php

namespace App\Services\Report;

use App\Repositories\TransactionReportRepository;
use App\Services\BaseDateRange;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TopSellingProduct extends BaseDateRange
{
    public function handle(): array
    {
        [$start, $end] = $this->resolveDateRange('month');

        $key = $this->cacheKey($start, $end);

        Log::info('[TopSellingProduct] cache_key', [
            'key'   => $key,
            'start' => $start->toDateTimeString(),
            'end'   => $end->toDateTimeString(),
            'hit'   => Cache::has($key),
        ]);

        return Cache::remember(
            $key,
            now()->addHours(3),
            fn () => $this->mapResult(
                app(TransactionReportRepository::class)
                    ->BestSeliing($start, $end)
            )
        );
    }

    protected function mapResult($rows): array
    {
        return $rows->map(fn ($row) => [
            'label'  => $row->type_hp,
            'total'  => (int) $row->total,
            'amount' => (float) $row->total_amount,
        ])->values()->toArray();
    }

    protected function cacheKey($start, $end): string
    {
        return 'topSellingProduct:' .
            $start->format('Ymd') . ':' .
            $end->format('Ymd');
    }
}
