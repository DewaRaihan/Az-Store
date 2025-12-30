<?php

namespace App\Livewire\Forms\Request;

use Illuminate\Validation\Rule;

class TrasactionFormRequest
{
    public static function rules(string $form): array
    {
        return match ($form) {

            // =========================
            // TRANSACTION (UMUM)
            // =========================
            'transaction' => [
                'transaction.id' => ['nullable', 'exists:transactions,id'],
                'transaction.date' => ['required', 'date'],
                'transaction.type_transaction' => [
                    'required',
                    'string',
                    Rule::in(['jual_langsung', 'tukar_tambah', 'beli_barang']),
                ],
                'transaction.note_transaction' => ['nullable', 'string'],
            ],

            // =========================
            // PURCHASE / BELI BARANG
            // =========================
            'purchase' => [
                'purchase.main_image' => ['nullable', 'image', 'max:2048'],
                'purchase.additional_images.*' => ['nullable', 'image', 'max:2048'],
                'purchase.hp_in' => ['required', 'string', 'max:55'],
                'purchase.purchase_price' => ['required', 'numeric'],
                'purchase.catalog_price' => ['nullable', 'numeric'],
                'purchase.notes' => ['nullable', 'string', 'max:255'],
            ],

            // =========================
            // DIRECT SELLING / JUAL LANGSUNG
            // =========================
            'selling' => [
                'hp_out' => [
                    'required',
                    Rule::exists('hps', 'type_hp'),
                ],
                'selling_price' => ['required', 'numeric'],
                'notes' => ['nullable', 'string', 'max:255'],
            ],

            // =========================
            // TRADE IN / TUKAR TAMBAH
            // =========================
            'trade_in' => [
                'trade_in.hp_out' => [
                    'required',
                    Rule::exists('hps', 'type_hp'),
                ],
                'trade_in.hp_in' => ['required', 'string', 'max:55'],
                'trade_in.extra_money' => ['required', 'numeric'],
                'trade_in.notes' => ['nullable', 'string', 'max:255'],
            ],

            // =========================
            // DETAIL UNIT
            // =========================
            'detail' => [
                'detail.internal' => ['required', 'string'],
                'detail.network' => ['required', 'string'],
                'detail.product_completeness' => ['required', 'string'],
                'detail.battery' => ['nullable', 'string'],
                'detail.battery_health' => ['required', 'string'],
                'detail.screen' => ['nullable', 'string'],
                'detail.body' => ['nullable', 'string'],
                'detail.face_id' => ['nullable', 'string'],
                'detail.true_tone' => ['nullable', 'string'],
                'detail.finger_print' => ['nullable', 'string'],
                'detail.front_camera' => ['nullable', 'string'],
                'detail.rear_camera' => ['nullable', 'string'],
                'detail.other' => ['nullable', 'string', 'max:255'],
            ],

            default => [],
        };
    }

    public static function messages(): array
    {
        return [
            'transaction.date.required' => 'Tanggal transaksi wajib diisi',
            'transaction.type_transaction.required' => 'Jenis transaksi wajib dipilih',

            'purchase.hp_in.required' => 'Tipe HP wajib diisi',
            'purchase.purchase_price.required' => 'Harga beli wajib diisi',

            'direct_selling.hp_out.required' => 'Unit HP wajib dipilih',
            'direct_selling.selling_price.required' => 'Harga jual wajib diisi',

            'trade_in.hp_out.required' => 'Unit HP keluar wajib dipilih',
            'trade_in.hp_in.required' => 'Unit HP masuk wajib diisi',

            'detail.battery_health.required' => 'Kesehatan baterai wajib diisi',
        ];
    }
}
