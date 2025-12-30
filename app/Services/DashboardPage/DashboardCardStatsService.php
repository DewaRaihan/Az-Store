<?php

namespace App\Services\DashboardPage;

use App\Services\CardStats\ProfitStats;
use App\Services\CardStats\ReadyUnitCounterStats;
use App\Services\CardStats\SpendingStats;
use App\Services\CardStats\IncomeStats;
use App\Services\CardStats\UnitBoughtStats;
use App\Services\CardStats\UnitSoldStats;

class DashboardCardStatsService
{
    protected array $cards;

    public function __construct()
    {
        $this->cards = [
            'income' => new IncomeStats(),
            'spending' => new SpendingStats(),
            'profit' => new ProfitStats(),
            'unitSold' =>new UnitSoldStats(),
            'unitBought' => new UnitBoughtStats(),
            'readyUnitCount' => new ReadyUnitCounterStats()
        ];
    }
    public function handle(string|null $filter = null)
    {
        $result = [];
        
        foreach ($this->cards as $key => $card) {
            $result[$key] = $card->handle($filter);
        }

        \Log::info('DashboardCardStat handled', [
            'filter' => $filter,
            'data' => $result,
        ]);

        return $result;
    }
}