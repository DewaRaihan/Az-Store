<?php

namespace App\Services\Forms;

use App\Models\Transaction;
use App\Services\Forms\Handler\PurchaseHandler;
use App\Services\Forms\Handler\SellingHandler;
use App\Services\Forms\Handler\TradeHandler;
use App\Services\Forms\Handler\DetailHandler;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;

class TransactionFormService
{
    public function store(array $payload): Transaction
    {
        $this->validate($payload);

        return DB::transaction(function () use ($payload) {

            $type = $payload['transaction']['type_transaction'];

            Log::info('TransactionService: Starting store', [
                'type' => $type,
                'payload_keys' => array_keys($payload),
                'has_detail' => !empty($payload['detail']),
            ]);

            /* ================= CREATE TRANSACTION ================= */

            $transaction = Transaction::create([
                'transaction_code' => $payload['transaction']['transaction_code']
                    ?? $this->generateCode($type),
                'date'   => $payload['transaction']['date'],
                'type_transaction' => $type, // ✅ KONSISTEN
                'user_id' => auth()->id(),
                'note'    => $payload['transaction']['note'] ?? null,
            ]);

            Log::info('TransactionService: Transaction created', [
                'id' => $transaction->id,
                'code' => $transaction->transaction_code,
            ]);

            /* ================= DETAIL ================= */

            $detail = null;
            if (!empty($payload['detail'])) {
                Log::info('TransactionService: Processing detail', [
                    'detail_keys' => array_keys($payload['detail']),
                ]);

                $detail = app(DetailHandler::class)->handle($payload['detail']);

                Log::info('TransactionService: Detail created', [
                    'detail_id' => $detail->id,
                ]);
            }

            /* ================= HANDLER ================= */

            switch ($type) {
                case 'purchase':
                    Log::info('TransactionService: Call PurchaseHandler');
                    app(PurchaseHandler::class)
                        ->handle($transaction, $payload['purchase'], $detail);
                    break;

                case 'selling':
                    app(SellingHandler::class)
                        ->handle($transaction, $payload['selling'], $detail);
                    break;

                case 'trade':
                    app(TradeHandler::class)
                        ->handle($transaction, $payload['trade'], $detail);
                    break;

                default:
                    throw new InvalidArgumentException("Jenis transaksi tidak valid: {$type}");
            }

            Log::info('TransactionService: Store completed', [
                'transaction_id' => $transaction->id,
                'type' => $type,
            ]);

            return $transaction;
        });
    }

    /* ================= VALIDATION ================= */

    protected function validate(array $payload): void
    {
        if (empty($payload['transaction']['type_transaction'])) {
            throw new InvalidArgumentException('Type transaksi wajib diisi');
        }

        $type = $payload['transaction']['type_transaction'];

        if (!in_array($type, ['purchase', 'selling', 'trade'])) {
            throw new InvalidArgumentException('Jenis transaksi tidak valid');
        }

        if (empty($payload[$type])) {
            throw new InvalidArgumentException("Data form {$type} belum diisi");
        }

        if ($type === 'purchase') {
            $this->validatePurchase($payload['purchase']);
        }
    }

    protected function validatePurchase(array $purchase): void
    {
        if (empty($purchase['hp']['hp_in'])) {
            throw new InvalidArgumentException('Nama HP wajib diisi');
        }

        if (empty($purchase['transaction']['purchase_price'])) {
            throw new InvalidArgumentException('Harga beli wajib diisi');
        }

        if (empty($purchase['images']['main'])) {
            throw new InvalidArgumentException('Foto utama wajib diupload');
        }
    }

    protected function generateCode(string $type): string
    {
        $prefix = match ($type) {
            'purchase' => 'PUR',
            'selling'  => 'SEL',
            'trade'    => 'TRD',
            default    => 'TRX'
        };

        do {
            $code = $prefix . '-' . random_int(10000, 99999);
        } while (Transaction::where('transaction_code', $code)->exists());

        return $code;
    }
}
