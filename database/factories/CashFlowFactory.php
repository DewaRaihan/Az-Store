<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CashFlow>
 */
class CashFlowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = $this->faker->randomElement(['purchase', 'selling', 'service', 'oprasional']);
        $type_trans = in_array($category, ['selling', 'service']) ? 'in' : 'out';

        $amount = $this->faker->numberBetween(100000, 20000000);
        $profit = ($type_trans === 'in')
            ? $this->faker->numberBetween(50000, $amount / 10)
            : 0;

        return [
            'transaction_id' => \App\Models\Transaction::factory(),
            'service_id' => \App\Models\ServiceHp::factory(),
            'oprasional_id' => \App\Models\Oprasional::factory(),
            'type_trans' => $type_trans,
            'category' => $category,
            'amount' => $amount,
            'profit' => $profit,
        ];
    }
}
