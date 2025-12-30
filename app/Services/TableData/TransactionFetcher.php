<?php

namespace App\Services\Tabledata;

use App\Services\Contracts\DataFetcherInterface;
use App\Services\Traits\ConvertDataTrait;

class TransactionFetcher implements DataFetcherInterface
{
    use ConvertDataTrait;

    public function format($trx): array
    {
        $hpIn  = $trx->hpIn;
        $hpOut = $trx->hpOut;
        $related = $trx->related;

        // resolve related price (purchase / selling / trade)
        $relatedPrice = null;
        if ($related) {
            $relatedPrice =
                $related->purchase_price
                ?? $related->selling_price
                ?? $related->extra_fee;
        }

        return [
            "transaction_code" => $trx->transaction_code,
            "date" => $trx->date,
            "type_trans" => $trx->type_trans,

            "hp_in" => $hpIn ? [
                'code_hp' => $hpIn->code_hp,
                'type_hp' => $hpIn->type_hp,
            ] : null,

            "hp_out" => $hpOut ? [
                'code_hp' => $hpOut->code_hp,
                'type_hp' => $hpOut->type_hp,
            ] : null,

            'related' => $related ? [
                'transaction_code' => $related->transaction_code,
                'price' => $relatedPrice,
            ] : null,

            "extra_fee" => $trx->extra_fee,
            "purchase_price" => $trx->purchase_price,
            "selling_price" => $trx->selling_price,
            "profit" => $trx->profit,
            "notes" => $trx->notes,

            'customer_id' => $trx->customers->name ?? 'unknown',
            'user_id' => $trx->users?->name,
        ];
    }

    public function formatCollection($data): mixed
    {
        $collection = $this->convertToCollection($data);

        return $collection
            ->map(fn ($trx) => $this->format($trx))
            ->values();
    }
}
