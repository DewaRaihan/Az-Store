<?php

namespace App\Repositories;

use App\Models\Transaction;
use DB;

class TransactionReportRepository
{
    public function BestSeliing($start, $end)
    {
        return Transaction::query()
                ->join('hps as hpo', 'transactions.hp_out', '=', 'hpo.id')
                ->when($start && $end, fn($q) =>
                    $q->whereBetween('transactions.created_at', [$start, $end])
                )
                ->select(
                    'hpo.type_hp',
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(transactions.selling_price) as total_amount')
                )
                ->groupBy('hpo.type_hp')
                ->orderByDesc('total')
                ->take(10)
                ->get();
    }
}