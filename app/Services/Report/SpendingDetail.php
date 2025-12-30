<?php

namespace App\Services\Report;

use App\Repositories\CashFlowRepository;
use App\Services\BaseDateRange;
use App\Services\Contracts\DataFetcherInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SpendingDetail extends BaseDateRange
{
    protected array $categories = [
        'purchase'     => 'Pembelian HP',
        'service'     => 'Service',
        'oprasional'  => 'Oprasional',
    ];

    public function __construct(
        protected CashFlowRepository $cashflow
    ) {
        $this->resolveDateRange('month');
    }

    public function fetch(): Collection
    {
        [$start, $end] = $this->resolveDateRange('month');
        $cacheKey = $this->cacheKey($start, $end);

        // 🔍 DEBUG: info fetch
        $this->debug('Fetch spending detail', [
            'range'     => $this->resolveDateRange(),
            'start'     => $start->toDateTimeString(),
            'end'       => $end->toDateTimeString(),
            'cache_key' => $cacheKey,
        ]);

        if (Cache::has($cacheKey)) {
            $this->debug('Cache HIT', ['cache_key' => $cacheKey]);
        } else {
            $this->debug('Cache MISS → build from DB', ['cache_key' => $cacheKey]);
        }

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(5),
            function () use ($start, $end) {
                return $this->build($start, $end);
            }
        );
    }

    protected function build($start, $end): Collection
    {
        $this->debug('Building spending detail from repository');

        return collect($this->categories)->map(function ($label, $category) use ($start, $end) {

            $total = $this->cashflow
                ->totalAmountCashflowInOrOutAndWhereBetween('out', $start, $end);

            $amount = $this->cashflow
                ->sumByCategoryAndWhereBetween($category, $start, $end);
            
            $count = $this->cashflow
                ->countCashflowByCategoryAndWhereBetween($category, $start, $end);
            
            $percent = $total > 0 
                ? round(($amount/$total) * 100)
                : 0;
            
            $daysPassed = max($start->diffInDays(now()) + 1, 1);
            $avgPerDays = $amount / $daysPassed;

            $avgTransaction = $count > 0
                            ? round($amount / $count)
                            : null; // atau 0, atau '-'


            // 🔍 DEBUG per kategori
            $this->debug('Category calculated', [
                'total' => $total,
                'category' => $category,
                'amount'   => $amount,
                'count' => $count,
                'percent' => $percent,
                'avgPerDays' => $avgPerDays,
                'avgTransaction' => $avgTransaction
            ]);

            return [
                'total' => $total,
                'key'    => $category,
                'name'   => $label,
                'amount' => $amount,
                'count' => $count,
                'percent' => $percent,
                'avgPerDays' => $avgPerDays,
                'avgTransaction' => $avgTransaction
            ];
        })->values();
    }

    protected function cacheKey($start, $end): string
    {
        return sprintf(
            'report:spending:%s:%s',
            $start->format('Ymd'),
            $end->format('Ymd')
        );
    }

    protected function debug(string $message, array $context = []): void
    {
        if (!config('app.debug')) {
            return;
        }

        Log::debug('[SpendingDetailService] ' . $message, $context);
    }
}
