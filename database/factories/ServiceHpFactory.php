<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceHp>
 */
class ServiceHpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'services_code' => 'SRV-' . $this->faker->unique()->numerify('###'),
            'date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'hp_id' => \App\Models\Hp::factory(), // relasi ke HP yang diservice
            'cost' => $this->faker->randomFloat(2, 50000, 2000000), // biaya service
            'notes' => $this->faker->randomElement([
                'Ganti LCD',
                'Ganti baterai',
                'Perbaikan kamera',
                'Membersihkan port',
                'tidak ada catatan',
            ]),
            'user_id' => \App\Models\User::factory(), // relasi ke user
        ];
    }
}
