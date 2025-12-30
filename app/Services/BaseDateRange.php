<?php

namespace App\Services;

use Carbon\Carbon;

abstract class BaseDateRange
{
    /**
     * Summary of resolveDateRange
     * @param mixed $filter
     * @return array<Carbon|\Illuminate\Support\Carbon>
     */

    protected function resolveDateRange(null|string $filter = null): array
    {
        return match ($filter) {

            'day' => [
                now()->startOfDay()->subHours(3),
                now()->endOfDay()->subHours(3),
            ],

            'week' => [
                now()->startOfWeek(Carbon::MONDAY)->subHours(3),
                now()->endOfWeek(Carbon::SUNDAY)->subHours(3),
            ],

            'month' => [
                now()->startOfMonth()->subHours(3),
                now()->endOfMonth()->subHours(3),
            ],

            'last_1_month' => [
                now()->subMonthsNoOverflow(1)->startOfMonth()->subHours(3),
                now()->subMonthsNoOverflow(1)->endOfMonth()->subHours(3),
            ],

            'last_2_month' => [
                now()->subMonthsNoOverflow(2)->startOfMonth()->subHours(3),
                now()->subMonthsNoOverflow(2)->endOfMonth()->subHours(3),
            ],

            'last_3_month' => [
                now()->subMonthsNoOverflow(3)->startOfMonth()->subHours(3),
                now()->subMonthsNoOverflow(3)->endOfMonth()->subHours(3),
            ],

            'quarter' => [
                now()->startOfQuarter(),
                now()->endOfQuarter(),
            ],

            'year' => [
                now()->startOfYear(),
                now()->endOfYear(),
            ],

            default => [
                Carbon::today()->subHours(3),
                Carbon::tomorrow()->subHours(3),
            ],
        };
    }


    /**
     * Summary of getGeneralLabels
     * @param string $type
     * @param int $start
     * @param int $end
     * @return array
     */
    public function getGeneralLabels(string $type = 'hour', int $start = 0, int $end = 0)
    {
        return range($start, $end);
    }
}
