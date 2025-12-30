<?php

namespace App\Services\FinancialStatement;

use App\Services\CardStats\AvgSpendingStats;
use App\Services\CardStats\IncomeStats;
use App\Services\CardStats\MonthlyAvgSpendingStats;
use App\Services\CardStats\MonthlyIncomeStats;
use App\Services\CardStats\MonthlyNetProfitStats;
use App\Services\CardStats\MonthlyProfitMarginStats;
use App\Services\CardStats\MonthlySpendingStats;
use App\Services\CardStats\NetProfitStats;
use App\Services\CardStats\QuarterIncomeStats;
use App\Services\CardStats\QuarterNetProfitStats;
use App\Services\CardStats\QuarterProfitMarginStats;
use App\Services\CardStats\QuarterSpendingStats;
use App\Services\CardStats\SpendingStats;
use App\Services\CardStats\TotalIncomeStats;
use App\Services\CardStats\TotalNetProfitStats;
use App\Services\CardStats\TotalProfitMarginStats;
use App\Services\CardStats\TotalSpendingStats;
use App\Services\CardStats\TotalUnitSoldStats;
use App\Services\CardStats\TransactionCountStats;


class FinancialStatementCardStatsService
{
    protected array $cards;

    public function __construct()
    {
        $this->cards = [
            'income' => new IncomeStats(),
            'monthlyIncome' => new MonthlyIncomeStats(),
            'quarterIncome' => new QuarterIncomeStats(),
            'totalIncome' => new TotalIncomeStats(),
            'spending' => new SpendingStats(),
            'monthlySpending' => new MonthlySpendingStats(),
            'quarterSpending' => new QuarterSpendingStats(),
            'totalSpending' => new TotalSpendingStats(),
            'netProfit'=> new NetProfitStats(),
            'monthlyNetProfit' => new MonthlyNetProfitStats(),
            'quarterNetProfit' => new QuarterNetProfitStats(),
            'totalNetProfit' => new TotalNetProfitStats(),
            'monthlyProfitMargin' => new MonthlyProfitMarginStats(),
            'quarterProfitMargin' => new QuarterProfitMarginStats(),
            'totalProfitMargin' => new TotalProfitMarginStats(),
            'transactionCount' => new TransactionCountStats(),
            'avgSpending' => new AvgSpendingStats(),
            'monthlyAvgSpending' => new MonthlyAvgSpendingStats(), 
            'totalUnitSold' => new TotalUnitSoldStats(),
        ];
    }
    public function handle(string|null $filter = null)
    {
        $result = [];
        
        foreach ($this->cards as $key => $card) {
            $result[$key] = $card->handle($filter);
        }

        \Log::info('FinancialStatementCardStat handled', [
            'filter' => $filter,
            'data' => $result,
        ]);

        return $result;
    }
}