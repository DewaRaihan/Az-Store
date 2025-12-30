<?php

namespace App\Services\Report;

use App\Models\CashFlow;
use App\Models\Transaction;

class CashFlowService
{
    /**
     * Cashflow from purchase (uang keluar)
     */
    public function fromPurchase(Transaction $transaction): CashFlow
    {
        if (empty($transaction->purchase_price)) {
            throw new \InvalidArgumentException('Purchase price tidak boleh kosong');
        }

        return CashFlow::create([
            'transaction_id' => $transaction->id,
            'type_trans'     => 'purchase',
            'category'       => 'purchase',
            'amount'         => -abs($transaction->purchase_price),
            'profit'         => 0,
            'created_at'     => $transaction->date,
        ]);
    }

    /**
     * Cashflow from selling (uang masuk)
     */
    public function fromSelling(Transaction $transaction): CashFlow
    {
        if (empty($transaction->selling_price)) {
            throw new \InvalidArgumentException('Selling price tidak boleh kosong');
        }

        return CashFlow::create([
            'transaction_id' => $transaction->id,
            'type_trans'     => 'selling',
            'category'       => 'selling',
            'amount'         => abs($transaction->selling_price),
            'profit'         => $transaction->profit ?? 0,
            'created_at'     => $transaction->date,
        ]);
    }

    /**
     * Delete cashflow by transaction
     */
    public function deleteByTransaction(int $transactionId): void
    {
        CashFlow::where('transaction_id', $transactionId)->delete();
    }
}
