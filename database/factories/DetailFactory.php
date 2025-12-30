<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->randomElement(['Apple', 'Samsung', 'Xiaomi', 'Oppo', 'Vivo']),
            'storage' => $this->faker->randomElement(['64GB', '128GB', '256GB', '512GB']),
            'color' => $this->faker->randomElement(['Merah', 'Biru', 'Putih', 'Hitam']),
            'network' => $this->faker->randomElement(['ibox', 'beacukai', 'whitelist', 'all operator', 'wifi only']),
            'warranty' => $this->faker->randomElement(['resmi', 'tidak resmi']),
            'display' => $this->faker->randomElement(['normal', 'ganti layar', 'retak']),
            'body' => $this->faker->randomElement(['normal', 'lecet ringan', 'lecet parah', 'dent']),
            'battery' => $this->faker->randomElement(['normal', 'ganti baterai']),
            'battery_health' => $this->faker->numberBetween(75, 100) . '%',
            'face_id' => $this->faker->randomElement(['normal', 'off']),
            'true_tone' => $this->faker->randomElement(['normal', 'off']),
            'finger_print' => $this->faker->randomElement(['normal', 'off']),
            'front_camera' => $this->faker->randomElement(['normal', 'gantian kamera', 'jamur', 'rusak ringan', 'rusak berat']),
            'rear_camera' => $this->faker->randomElement(['normal', 'gantian kamera', 'jamur', 'rusak ringan', 'rusak berat']),
            'other' => $this->faker->sentence(),
        ];
    }
}
