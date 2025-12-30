<?php

namespace App\Services\Tabledata;

use App\Services\Contracts\DataFetcherInterface;
use App\Services\Traits\ConvertDataTrait;

class HpFetcher implements DataFetcherInterface
{
    use ConvertDataTrait;
    public function format($hps): array
    {
        // Ambil 1 transaksi masuk/keluar
        $transactionIn  = $hps->transactionIn->first();
        $transactionOut = $hps->transactionOut->first();
        
        logger()->info('HP FETCHER DEBUG', [
            'hp_id' => $hps->id,
            'hp_code' => $hps->code_hp,
            'transaction_in_id' => $transactionIn?->id,
            'transaction_in_type' => $transactionIn?->type_trans,
            'purchase_price' => $transactionIn?->purchase_price,
            'extra_fee' => $transactionIn?->extra_fee,
        ]);

        // Harga dasar
        $purchasePrice = $transactionIn?->purchase_price;
        $sellingPrice  = $transactionOut?->selling_price;

        // Trade-in source
        $sourceOfHps = null;
        if ($transactionIn && is_null($purchasePrice) && $transactionIn->related) {
            $sourceOfHps = $transactionIn->related->hpIn ?? null;
        }

        // Trade-out result
        $becomeHps = null;
        if ($transactionOut && is_null($sellingPrice) && $transactionOut->related) {
            $becomeHps = $transactionOut->related->hpOut ?? null;
        }

        $purchase = [
            'purchase_price' => $purchasePrice ?? $transactionIn?->extra_fee ?? null,
            'is_trade' => $sourceOfHps?->code_hp ?? null
        ];

        $selling = [
            'selling_price' => $sellingPrice ?? null,
            'is_trade' => $becomeHps?->code_hp ?? null
        ];

        return [
            'id' => $hps->id,
            'code_hp' => $hps->code_hp,
            'date' => $hps->date,
            'type_hp' => $hps->type_hp,
            'grade' => $hps->grade,
            'status' => $hps->status,
            'price_in_catalog' => $hps->price_in_catalog,
            'notes' => $hps->notes,
            'transaction' => [
                'purchase' => $purchase,
                'selling'  => $selling
            ],
        ];
    }

    public function formatCollection($data): mixed
    {
        // Convert paginator to collection
        $collection = $this->convertToCollection($data);

        return $collection->map(fn($hps) => $this->format($hps))->values();
    }
}
