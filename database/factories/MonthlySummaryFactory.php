<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonthlySummary>
 */
class MonthlySummaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total_purchase = $this->faker->numberBetween(5000000, 50000000);
        $total_selling = $this->faker->numberBetween(10000000, 100000000);
        $total_service = $this->faker->numberBetween(100000, 2000000);
        $total_oprasional = $this->faker->numberBetween(500000, 5000000);
        $total_profit = $total_selling - ($total_purchase + $total_service + $total_oprasional);

        return [
            'year' => $this->faker->year(),
            'month' => $this->faker->monthName(),
            'total_purchase' => $total_purchase,
            'total_selling' => $total_selling,
            'total_service' => $total_service,
            'total_oprasional' => $total_oprasional,
            'total_profit' => $total_profit,
        ];
    }
}
