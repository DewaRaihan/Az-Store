<?php

namespace App\Services\TransactionPage;

use App\Services\CardStats\DailyTransactionCountStats;
use App\Services\CardStats\IncomeStats;
use App\Services\CardStats\MonthlyIncomeStats;
use App\Services\CardStats\MonthlySpendingStats;
use App\Services\CardStats\MonthlyTransactionCountStats;
use App\Services\CardStats\SpendingStats;
use App\Services\CardStats\TotalIncomeStats;
use App\Services\CardStats\TotalSpendingStats;
use App\Services\CardStats\TransactionCountStats;


class TransactionCardStatsService
{
    protected array $cards;

    public function __construct()
    {
        $this->cards = [
            'income' => new IncomeStats(),
            'monthlyIncome' => new MonthlyIncomeStats(),
            'totalIncome' => new TotalIncomeStats(),
            'spending' => new SpendingStats(),
            'monthlySpending' => new MonthlySpendingStats(),
            'totalSpending' => new TotalSpendingStats(),
            'dailyTransactionCount' => new DailyTransactionCountStats(),
            'monthlyTransactionCount' => new MonthlyTransactionCountStats(),
            'transactionCount' => new TransactionCountStats(),
        ];
    }
    public function handle(string|null $filter = null)
    {
        $result = [];
        
        foreach ($this->cards as $key => $card) {
            $result[$key] = $card->handle($filter);
        }

        \Log::info('TransactionCardStat handled', [
            'filter' => $filter,
            'data' => $result,
        ]);

        return $result;
    }
}