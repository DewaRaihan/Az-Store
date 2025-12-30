<?php

namespace App\Services\Report;

use App\Repositories\CashFlowRepository;
use App\Repositories\OprasionalRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TransactionRepository;
use App\Services\BaseDateRange;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Log;


class cashFlowStatement extends BaseDateRange
{
    public function __construct(
        protected TransactionRepository $transaction, 
        protected OprasionalRepository $oprasional, 
        protected ServiceRepository $service,
    ){}

    public function fetch(string $filter = 'month'): Collection
    {
        [$start, $end] = $this->resolveDateRange($filter);
        $cacheKey = $this->cacheKey($start, $end);

        // 🔍 DEBUG: info fetch
        $this->debug('Fetch cashflow statement', [
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
            fn() => $this->build($start, $end)
        );
    }
    public function build($start, $end)
    {
        $this->debug('Building Cashflow Statemnet from repository');

        $income = $this->transaction
                ->amountTypetransAndWhereBetween('selling', 'selling_price', $start, $end);

        $extraFee = $this->transaction
                ->amountTypetransAndWhereBetween('trade', 'extra_fee', $start, $end);
                
        $totalIncome = round($income + $extraFee);
                
        $spending = $this->transaction
                ->amountTypetransAndWhereBetween('purchase', 'purchase_price', $start, $end);

        $oprasionalCost = $this->oprasional
                ->sumCostAndWhereBetween($start, $end);

        $serviceCost = $this->service
                ->sumCostAndWhereBetween($start, $end);

        $totalSpending = round($spending + $oprasionalCost + $serviceCost);

        $netCashFlow = round($totalIncome - $totalSpending);

        //catatan: kurang kas akhir dan modal awal

        // 🔍 DEBUG per kategori
        $this->debug('Category and Type Trans calculated', [
            'income' => $income,
            'extra_fee' => $extraFee,
            'totalIncome' => $totalIncome,
            'spending' => $spending,
            'oprasional' => $oprasionalCost,
            'service' => $serviceCost,
            'totalSpending' => $totalSpending,
            'netCashFlow' => $netCashFlow
        ]);
        
        return collect([
            'income' => $income,
            'extra_fee' => $extraFee,
            'totalIncome' => $totalIncome,
            'spending' => $spending,
            'oprasional' => $oprasionalCost,
            'service' => $serviceCost,
            'totalSpending' => $totalSpending,
            'netCashFlow' => $netCashFlow
        ]);
    }
    protected function cacheKey($start, $end): string
    {
        return sprintf(
            'report:cashflow:%s:%s',
            $start->format('Ymd'),
            $end->format('Ymd')
        );
    }

    protected function debug(string $message, array $context = []): void
    {
        if (!config('app.debug')) {
            return;
        }

        Log::debug('[CashflowStatementService] ' . $message, $context);
    }
}