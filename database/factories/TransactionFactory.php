<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeTrans = $this->faker->randomElement(['purchase', 'selling', 'trade']);
        
        // Harga yang realistis berdasarkan jenis transaksi
        $purchasePrice = $this->faker->numberBetween(1000000, 15000000);
        $sellingPrice = $purchasePrice + $this->faker->numberBetween(300000, 5000000);
        $extraFee = $this->faker->numberBetween(0, 300000);

        // Selalu buat customer dan HP karena constrained tidak boleh null
        $customer = \App\Models\Customer::factory()->create();
        $hpIn = \App\Models\Hp::factory()->create();
        $hpOut = \App\Models\Hp::factory()->create();

        return [
            'transaction_code' => 'TRX-' . $this->faker->unique()->numerify('#####'),
            'date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'type_trans' => $typeTrans,
            'hp_in' => $hpIn->id,
            'hp_out' => $hpOut->id,
            'related_transaction_id' => null,
            'extra_fee' => $extraFee,
            'purchase_price' => $purchasePrice,
            'selling_price' => $sellingPrice,
            'profit' => $sellingPrice - $purchasePrice - $extraFee,
            'notes' => $this->faker->sentence(6),
            'user_id' => \App\Models\User::factory(),
            'customer_id' => $customer->id,
        ];
    }

    /**
     * State untuk transaksi pembelian (hp_in saja yang aktif)
     */
    public function purchase()
    {
        return $this->state(function (array $attributes) {
            $purchasePrice = $this->faker->numberBetween(1000000, 12000000);
            $hpIn = \App\Models\Hp::factory()->create();
            
            return [
                'type_trans' => 'purchase',
                'purchase_price' => $purchasePrice,
                'selling_price' => 0,
                'hp_in' => $hpIn->id,
                'hp_out' => null, // Tetap harus ada HP, tapi bisa null sesuai migration
                'profit' => 0,
                'extra_fee' => $this->faker->numberBetween(50000, 200000),
                'notes' => 'Pembelian HP - ' . $this->faker->sentence(3),
            ];
        });
    }

    /**
     * State untuk transaksi penjualan (hp_out saja yang aktif)
     */
    public function selling()
    {
        return $this->state(function (array $attributes) {
            $purchasePrice = $this->faker->numberBetween(1500000, 10000000);
            $sellingPrice = $purchasePrice + $this->faker->numberBetween(500000, 3000000);
            $extraFee = $this->faker->numberBetween(0, 150000);
            $hpOut = \App\Models\Hp::factory()->create();
            $customer = \App\Models\Customer::factory()->create();
            
            return [
                'type_trans' => 'selling',
                'purchase_price' => $purchasePrice,
                'selling_price' => $sellingPrice,
                'hp_in' => null, // Tetap harus ada HP, tapi bisa null sesuai migration
                'hp_out' => $hpOut->id,
                'profit' => $sellingPrice - $purchasePrice - $extraFee,
                'extra_fee' => $extraFee,
                'customer_id' => $customer->id,
                'notes' => 'Penjualan HP - ' . $this->faker->sentence(3),
            ];
        });
    }

    /**
     * State untuk transaksi trade-in (kedua HP aktif)
     */
    public function trade()
    {
        return $this->state(function (array $attributes) {
            $purchasePrice = $this->faker->numberBetween(2000000, 8000000);
            $hpIn = \App\Models\Hp::factory()->create();
            $hpOut = \App\Models\Hp::factory()->create();
            $customer = \App\Models\Customer::factory()->create();
            
            return [
                'type_trans' => 'trade',
                'purchase_price' => $purchasePrice,
                'selling_price' => 0,
                'hp_in' => $hpIn->id,
                'hp_out' => $hpOut->id,
                'profit' => 0,
                'extra_fee' => $this->faker->numberBetween(100000, 250000),
                'customer_id' => $customer->id,
                'notes' => 'Trade-in HP - ' . $this->faker->sentence(3),
            ];
        });
    }

    /**
     * State dengan tanggal tertentu
     */
    public function withDate($date)
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'date' => $date,
            ];
        });
    }

    /**
     * State dengan user tertentu
     */
    public function forUser($userId)
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }

    /**
     * State dengan customer tertentu
     */
    public function forCustomer($customerId)
    {
        return $this->state(function (array $attributes) use ($customerId) {
            return [
                'customer_id' => $customerId,
            ];
        });
    }

    /**
     * State dengan HP tertentu
     */
    public function withHpIn($hpId)
    {
        return $this->state(function (array $attributes) use ($hpId) {
            return [
                'hp_in' => $hpId,
            ];
        });
    }

    public function withHpOut($hpId)
    {
        return $this->state(function (array $attributes) use ($hpId) {
            return [
                'hp_out' => $hpId,
            ];
        });
    }
}