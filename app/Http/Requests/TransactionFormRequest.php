<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(string $form): array {
        return match ($form) {
            "transaction" => [
                "id" => ["nullable", "exists:transactions,id"],
                "date" => "required",
                "type_transaction" => ["required", "string", "in:jual_langsung,tukar_tambah,beli_barang"],
                "note_transaction" => ["string", "nullable"]
            ],
            "purchase" => [
                "hp_in" => ["required", "string", "max:55"],
                "purchase_price" => ["required", "string", "max:55"],
                "main_image" => ["nullable", "image", "max:2048"],
                "additional_images" => ["nullable", "image", "max:2048"],
                "catalog_price" => ["nullable", "string", "max:55"],
                "notes" => ["nullable", "string", "max:255"],
            ],
            "direct_selling" => [
                "hp_out" => ["required" , Rule::exists("hps", "type_hp")],
                "selling_price" => ["required", "string", "max:55"],
                "notes" => ["nullable", "string", "max:255"]
            ],
            "trade_in" => [
                "hp_out" => ["required" , Rule::exists("hps", "type_hp")],,
                "hp_in" => ["required", "string", "max:55"],
                "extra_money" => ["required", "string", "max:55"],
                "notes" => ["nullable", "string", "max:255"]
            ],
            "detail" => [
                "internal" => ["required", "string"],
                "network" => ["required", "string"],
                "product_completeness" => ["required", "string"],
                "batery" => ["nullable", "string"],
                "batery_health" => ["required", "string"],
                "screen" => ["nullable", "string"],
                "body" => ["nullable", "string"],
                "face_id" => ["nullable", "string"],
                "true_tone" => ["nullable", "string"],
                "finger_print" => ["nullable", "string"],
                "front_camera" => ["nullable", "string"],
                "rear_camera" => ["nullable", "string"],
                "other" => ["nullable", "string", "max:255"],
            ],
            default => []
        };
    }
    public function messages(){
        
    }
}
