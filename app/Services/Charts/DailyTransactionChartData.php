<?php

namespace App\Services\Charts;

use App\Models\CashFlow;
use App\Services\BaseDateRange;
use App\Services\Traits\DataFormatTrait;
use Carbon\Carbon;

class DailyTransactionChartData extends BaseDateRange
{
    use DataFormatTrait;

    /**
     * Data per hari (per jam)
     */
    public function getDailyIncomeData(?string $day = null, string $type = 'in'): array
    {
        $day = $day ?? now()->toDateString();
        [$start, $end] = $this->resolveDateRange(); // default daily

        $labels = $this->getGeneralLabels('hour', $start->hour, $end->hour);

        $data = CashFlow::query()
            ->selectRaw('HOUR(created_at) as hour, SUM(amount) as total')
            ->whereDate('created_at', $day)
            ->where('type_trans', $type)
            ->groupBy('hour')
            ->pluck('total', 'hour')
            ->toArray();

        $filledData = $this->fillData($labels, $data);

        return [
            'labels' => $labels,
            'data' => $filledData,
        ];
    }

    /**
     * Data per bulan (per tanggal)
     */
    public function getMonthlyIncomeData(?string $month = null, string $type = 'in'): array
    {
        $month = $month ?? now()->format('Y-m');
        [$start, $end] = $this->resolveDateRange('month');

        $daysInMonth = $start->daysInMonth;
        $labels = $this->getGeneralLabels('day', 1, $daysInMonth);

        $data = CashFlow::query()
            ->selectRaw('DAY(created_at) as day, SUM(amount) as total')
            ->whereMonth('created_at', $start->month)
            ->whereYear('created_at', $start->year)
            ->where('type_trans', $type)
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();

        $filledData = $this->fillData($labels, $data);

        return [
            'labels' => $labels,
            'data' => $filledData,
        ];
    }
}
