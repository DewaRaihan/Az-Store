<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('08##########'), // nomor HP Indonesia
            'customer_message' => $this->faker->sentence(), // pesan singkat pelanggan
        ];
    }
}
