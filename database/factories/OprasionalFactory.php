<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oprasional>
 */
class OprasionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cost = $this->faker->numberBetween(10000, 500000);
        $qty = $this->faker->numberBetween(1, 10);

        return [
            'oprasional_code' => 'OPR-' . $this->faker->unique()->numerify('###'),
            'name' => $this->faker->randomElement([
                'Listrik Toko',
                'Air Bulanan',
                'Sewa Etalase',
                'Peralatan Toko',
                'Biaya Promosi Online',
                'Konsumsi Pegawai',
                'Transportasi',
            ]),
            'cost' => $cost,
            'qty' => $qty,
            'notes' => $this->faker->randomElement([
                'Pembayaran rutin bulanan',
                'Pembelian alat pendukung',
                'tidak ada catatan',
            ]),
            'user_id' => \App\Models\User::factory(), // relasi ke user
        ];
    }
}
