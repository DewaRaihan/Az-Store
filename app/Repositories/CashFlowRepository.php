<?php

namespace App\Repositories;

use App\Models\CashFlow;


class CashFlowRepository
{
    public function sumByCategoryAndWhereBetween(string $category, $start, $end)
    {
        return CashFlow::where('category', $category)
                    ->whereBetween('created_at', [$start, $end])
                    ->sum('amount');
    }

    public function countCashflowByCategoryAndWhereBetween(string $category, $start, $end)
    {
        return CashFlow::where('category', $category)
                    ->whereBetween('created_at', [$start, $end])
                    ->count();
    }

    public function totalAmountCashflowInOrOutAndWhereBetween(string $type_trans, $start, $end)
    {
        return CashFlow::where('type_trans', $type_trans)
                    ->whereBetween('created_at', [$start, $end])
                    ->sum('amount');
    }
}