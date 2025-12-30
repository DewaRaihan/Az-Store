<?php

namespace App\Services\Forms\Handler;

use App\Models\Hp;
use App\Models\Transaction;
use App\Models\HpImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseHandler
{
    public function handle(
        Transaction $transaction,
        array $purchase,
        $detail
    ): void {
        Log::info('tetst DETAIL CREATED', [
            'detail_id' => $detail->id,
        ]);
        // Debug data yang masuk
        Log::info('PurchaseHandler: Processing purchase data', [
            'transaction_id' => $transaction->id,
            'purchase_keys' => array_keys($purchase),
            'has_images' => isset($purchase['images']),
            'images_main_type' => isset($purchase['images']['main']) ? gettype($purchase['images']['main']) : 'null',
            'images_additional_type' => isset($purchase['images']['additional']) ? gettype($purchase['images']['additional']) : 'null',
            'images_additional_is_array' => isset($purchase['images']['additional']) ? is_array($purchase['images']['additional']) : 'false',
            'hp_in' => $purchase['hp']['hp_in'] ?? 'not set',
            'purchase_price' => $purchase['transaction']['purchase_price'] ?? 'not set',
        ]);

        // Buat HP record
        $hp = Hp::create([
            'code_hp'          => 'HP-' . strtoupper(uniqid()),
            'date'             => now(),
            'type_hp'          => $purchase['hp']['hp_in'] ?? 'unknown',
            'grade'            => 'A', // Default grade
            'status'           => 'available',
            'price_in_catalog' => $purchase['hp']['catalog_price'] ?? null,
            'notes'            => $purchase['hp']['notes'] ?? null,
            'detail_id'        => $detail?->id,
        ]);

        Log::info('PurchaseHandler: HP created', [
            'hp_in' => $hp->id,
            'code_hp' => $hp->code_hp,
        ]);

        // Update transaction dengan HP id
        $transaction->update([
            'hp_in'          => $hp->id,
            'purchase_price' => $purchase['transaction']['purchase_price'] ?? null,
        ]);

        // Handle images - SEKARANG SUDAH STRING PATHS, BUKAN FILE OBJECTS
        $this->handleImages($hp, $purchase['images'] ?? []);
    }

    protected function handleImages(Hp $hp, array $images): void
    {
        Log::info('PurchaseHandler: Processing images', [
            'hp_id' => $hp->id,
            'has_main' => isset($images['main']),
            'main_type' => isset($images['main']) ? gettype($images['main']) : 'null',
            'main_value' => $images['main'] ?? 'null',
            'has_additional' => isset($images['additional']),
            'additional_count' => isset($images['additional']) ? count($images['additional']) : 0,
            'additional_type' => isset($images['additional']) ? gettype($images['additional']) : 'null',
        ]);

        // Main image - HARUS STRING PATH
        if (!empty($images['main'])) {
            // Pastikan ini string path, bukan file object
            if (is_string($images['main'])) {
                $hp->images()->create([
                    'path' => $images['main'],
                    'type' => 'main',
                ]);
                
                Log::info('PurchaseHandler: Main image saved', [
                    'hp_id' => $hp->id,
                    'path' => $images['main'],
                ]);
            } else {
                Log::warning('PurchaseHandler: Main image is not a string', [
                    'hp_id' => $hp->id,
                    'type' => gettype($images['main']),
                ]);
            }
        }

        // Additional images - HARUS ARRAY OF STRING PATHS
        if (!empty($images['additional']) && is_array($images['additional'])) {
            $savedCount = 0;
            
            foreach ($images['additional'] as $index => $imagePath) {
                // Pastikan ini string path
                if (is_string($imagePath) && !empty($imagePath)) {
                    $hp->images()->create([
                        'path' => $imagePath,
                        'type' => 'additional',
                    ]);
                    $savedCount++;
                    
                    Log::info('PurchaseHandler: Additional image saved', [
                        'hp_id' => $hp->id,
                        'index' => $index,
                        'path' => $imagePath,
                    ]);
                } else {
                    Log::warning('PurchaseHandler: Invalid additional image', [
                        'hp_id' => $hp->id,
                        'index' => $index,
                        'type' => gettype($imagePath),
                        'value' => $imagePath,
                    ]);
                }
            }
            
            Log::info('PurchaseHandler: Additional images processed', [
                'hp_id' => $hp->id,
                'total' => count($images['additional']),
                'saved' => $savedCount,
            ]);
        }
    }
}