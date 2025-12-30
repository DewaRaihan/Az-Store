<?php

namespace App\Services\Report;

use App\Repositories\CashFlowRepository;
use App\Services\BaseDateRange;
use Illuminate\Support\Facades\Cache;

class SpendingSummary extends BaseDateRange
{
    public function __construct(
        protected CashFlowRepository $cashflow
    ) {
        $this->resolveDateRange('month');
    }

    public function fetch(): array
    {
        [$start, $end] = $this->resolveDateRange('month');

        return Cache::remember(
            $this->cacheKey($start),
            now()->addMinutes(5),
            fn () => $this->build($start, $end)
        );
    }

    protected function build($start, $end): array
    {
        // 🔹 Total bulan ini
        $totalMonth = $this->cashflow
            ->totalAmountCashflowInOrOutAndWhereBetween('out', $start, $end);

        // 🔹 Hari ini
        [$dayStart, $dayEnd] = $this->resolveDateRange('day');
        $totalToday = $this->cashflow
            ->totalAmountCashflowInOrOutAndWhereBetween('out', $dayStart, $dayEnd);

        // 🔹 Minggu ini
        [$weekStart, $weekEnd] = $this->resolveDateRange('week');
        $totalWeek = $this->cashflow
            ->totalAmountCashflowInOrOutAndWhereBetween('out', $weekStart, $weekEnd);

        // 🔹 Perhitungan waktu
        $daysPassed = max($start->diffInDays(now()) + 1, 1);
        $daysInMonth = now()->daysInMonth;

        $avgPerDay = round($totalMonth / $daysPassed);


        return [
            'total' => $totalMonth,
            'today' => $totalToday,
            'week' => $totalWeek,
            'avg_per_day' => round($avgPerDay),
            'progress_percent' => round(($daysPassed / $daysInMonth) * 100),
        ];
    }

    protected function cacheKey($start): string
    {
        return "report:spending:summary:{$start->format('Ym')}";
    }
}
