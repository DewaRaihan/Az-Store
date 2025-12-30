<?php

namespace App\Services\InventoryPage;

use App\Services\CardStats\MonthlyUnitBoughtStats;
use App\Services\CardStats\MonthlyUnitSoldStats;
use App\Services\CardStats\TotalUnitBoughtStats;
use App\Services\CardStats\TotalUnitSoldStats;
use App\Services\CardStats\TotalUnitStats;
use App\Services\CardStats\UnitBoughtStats;
use App\Services\CardStats\UnitSoldStats;


class InventoryCardStatsService
{
    protected array $cards;

    public function __construct()
    {
        $this->cards = [
            'unitSold' => new UnitSoldStats(),
            'monthlyUnitSold' => new MonthlyUnitSoldStats(),
            'totalUnitSold' => new TotalUnitSoldStats(),
            'unitbought' => new UnitBoughtStats(),
            'monthlyUnitBought' => new MonthlyUnitBoughtStats(),
            'totalUnitBought' => new TotalUnitBoughtStats(),
            'totalUnit' => new TotalUnitStats()
        ];
    }
    public function handle(string|null $filter = null)
    {
        $result = [];
        
        foreach ($this->cards as $key => $card) {
            $result[$key] = $card->handle($filter);
        }

        \Log::info('InventoryCardStat handled', [
            'filter' => $filter,
            'data' => $result,
        ]);

        return $result;
    }
}