<?php

namespace App\Services\Forms\Handler;

use App\Models\Transaction;
use App\Models\Hp;
use App\Models\Customer;
use App\Models\Image;
use App\Services\Report\CashFlowService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SellingTransactionService
{
    /* =====================================================
     | CREATE SELLING
     |=====================================================*/
    public function createSelling(array $data)
    {
        // 🔴 DB TRANSACTION: HANYA QUERY DB
        $transaction = DB::transaction(function () use ($data) {

            // 1. Find HP
            $hp = Hp::findOrFail($data['transaction']['hp_out']);

            // 2. Customer
            $customer = null;
            if (!empty($data['customer']['name']) || !empty($data['customer']['phone'])) {
                $customer = Customer::firstOrCreate(
                    ['phone' => $data['customer']['phone'] ?? ''],
                    ['name' => $data['customer']['name'] ?? '']
                );
            }

            // 3. Purchase transaction
            $purchaseTransaction = Transaction::where('hp_in', $hp->id)
                ->where('type_trans', 'purchase')
                ->first();

            // 4. Profit
            $purchasePrice = $purchaseTransaction?->purchase_price ?? 0;
            $sellingPrice = $data['transaction']['selling_price'];
            $profit = $sellingPrice - $purchasePrice;

            // 5. Create selling transaction
            $transaction = Transaction::create([
                'transaction_code' => $data['transaction']['transaction_code'],
                'date' => $data['transaction']['date'],
                'type_trans' => 'selling',
                'hp_in' => null,
                'hp_out' => $hp->id,
                'related_transaction_id' => $purchaseTransaction?->id,
                'extra_fee' => 0,
                'purchase_price' => $purchasePrice,
                'selling_price' => $sellingPrice,
                'profit' => $profit,
                'notes' => $data['transaction']['notes'] ?? 'tidak ada catatan',
                'user_id' => auth()->id(),
                'customer_id' => $customer?->id,
            ]);

            // 6. Update HP status
            $hp->update(['status' => 'sold']);
            app(CashFlowService::class)
                ->fromSelling($transaction);

            return $transaction;
        });

        if (!empty($data['images'])) {
            $this->handleSalesImages($transaction, $data['images']);
        }

        return $transaction;
    }

    /* =====================================================
     | IMAGE UPLOAD (BATCH INSERT)
     |=====================================================*/
    private function handleSalesImages(Transaction $transaction, array $images): void
    {
        $records = [];
        $dir = 'transactions/selling/' . $transaction->id;

        foreach ($images as $image) {
            $path = $image->store($dir, 'public');

            $records[] = [
                'imageable_type' => Transaction::class,
                'imageable_id' => $transaction->id,
                'path' => $path,
                'status' => 'sales',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($records) {
            Image::insert($records);
        }
    }

    /* =====================================================
     | GET ALL SELLINGS
     |=====================================================*/
    public function getAllSellings()
    {
        return Transaction::where('type_trans', 'selling')
            ->with(['hp', 'hp.detail', 'customer', 'user', 'images'])
            ->orderByDesc('date')
            ->get();
    }

    /* =====================================================
     | GET SELLING BY ID
     |=====================================================*/
    public function getSellingById($id)
    {
        return Transaction::where('type_trans', 'selling')
            ->with(['hp', 'hp.detail', 'customer', 'user', 'images'])
            ->findOrFail($id);
    }

    /* =====================================================
     | UPDATE SELLING
     |=====================================================*/
    public function updateSelling($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $transaction = Transaction::where('type_trans', 'selling')->findOrFail($id);

            // Update transaction
            $transaction->update([
                'date' => $data['transaction']['date'] ?? $transaction->date,
                'selling_price' => $data['transaction']['selling_price'] ?? $transaction->selling_price,
                'notes' => $data['transaction']['notes'] ?? $transaction->notes,
            ]);

            // Update profit
            $transaction->profit =
                ($data['transaction']['selling_price'] ?? $transaction->selling_price)
                - $transaction->purchase_price;

            $transaction->save();

            // Update / create customer
            if (!empty($data['customer'])) {
                if ($transaction->customer_id) {
                    Customer::where('id', $transaction->customer_id)->update([
                        'name' => $data['customer']['name'] ?? null,
                        'phone' => $data['customer']['phone'] ?? null,
                    ]);
                } elseif (!empty($data['customer']['name']) || !empty($data['customer']['phone'])) {
                    $customer = Customer::firstOrCreate(
                        ['phone' => $data['customer']['phone'] ?? ''],
                        ['name' => $data['customer']['name'] ?? '']
                    );
                    $transaction->update(['customer_id' => $customer->id]);
                }
            }

            return $transaction->refresh()->load(['hp', 'hp.detail', 'customer', 'user', 'images']);
        });
    }

    /* =====================================================
     | DELETE SELLING
     |=====================================================*/
    public function deleteSelling($id)
    {
        return DB::transaction(function () use ($id) {
            $transaction = Transaction::where('type_trans', 'selling')->findOrFail($id);

            // Restore HP
            if ($transaction->hp) {
                $transaction->hp->update(['status' => 'available']);
            }

            // Delete images
            $this->deleteTransactionImages($transaction);

            $transaction->delete();

            return true;
        });
    }

    /* =====================================================
     | DELETE IMAGES
     |=====================================================*/
    private function deleteTransactionImages(Transaction $transaction): void
    {
        $images = $transaction->images()->where('status', 'sales')->get();

        foreach ($images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
        }

        $transaction->images()->where('status', 'sales')->delete();
    }
}
