<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['iPhone', 'Samsung', 'Xiaomi', 'Oppo', 'Vivo'];
        $models = [
            'iPhone' => ['11', '12', '13', '14', '15', 'XR', 'SE'],
            'Samsung' => ['Galaxy S21', 'Galaxy S22', 'Galaxy A54', 'Galaxy Note 20', 'Galaxy Z Flip'],
            'Xiaomi' => ['Redmi Note 12', 'Poco F5', 'Mi 13', 'Redmi 10'],
            'Oppo' => ['Reno 8', 'Find X5', 'A78', 'A96'],
            'Vivo' => ['V27', 'Y36', 'X90', 'T1']
        ];
        
        $brand = $this->faker->randomElement($brands);
        $model = $this->faker->randomElement($models[$brand]);
        $storage = $this->faker->randomElement(['64GB', '128GB', '256GB', '512GB']);
        $color = $this->faker->randomElement(['Black', 'White', 'Blue', 'Red', 'Green', 'Purple']);

        $grade = $this->faker->randomElement(['A', 'B', 'C', 'D']);
        $gradeNotes = [
            'A' => 'Kondisi sangat baik, seperti baru',
            'B' => 'Kondisi baik, ada sedikit bekas pakai', 
            'C' => 'Kondisi cukup, ada bekas pakai jelas',
            'D' => 'Kondisi kurang, perlu perawatan'
        ];

        return [
            "code_hp" => 'HP-' . $this->faker->unique()->numerify('#####'),
            'date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            "type_hp" => "{$brand} {$model}",
            'grade' => $grade,
            'status' => $this->faker->randomElement(['available', 'sold']),
            'price_in_catalog' => $this->faker->numberBetween(1500000, 25000000),
            "notes" => $gradeNotes[$grade] ?? 'Catatan untuk HP',
            "detail_id" => \App\Models\Detail::factory(),
        ];
    }

    /**
     * State untuk HP yang masih available
     */
    public function available()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'available',
                'notes' => 'HP tersedia di stock - ' . $this->faker->sentence(3),
            ];
        });
    }

    /**
     * State untuk HP yang sudah terjual
     */
    public function sold()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'sold',
                'notes' => 'Terjual - ' . $this->faker->sentence(3),
            ];
        });
    }

    /**
     * State untuk HP dengan grade tertentu
     */
    public function withGrade($grade)
    {
        return $this->state(function (array $attributes) use ($grade) {
            $gradeNotes = [
                'A' => 'Kondisi sangat baik, seperti baru',
                'B' => 'Kondisi baik, ada sedikit bekas pakai',
                'C' => 'Kondisi cukup, ada bekas pakai jelas',
                'D' => 'Kondisi kurang, perlu perawatan'
            ];

            return [
                'grade' => $grade,
                'notes' => $gradeNotes[$grade] ?? 'Catatan untuk HP',
            ];
        });
    }

    /**
     * State untuk brand tertentu
     */
    public function withBrand($brand)
    {
        $models = [
            'iPhone' => ['11', '12', '13', '14', '15'],
            'Samsung' => ['Galaxy S21', 'Galaxy S22', 'Galaxy A54'],
            'Xiaomi' => ['Redmi Note 12', 'Poco F5', 'Mi 13']
        ];

        return $this->state(function (array $attributes) use ($brand, $models) {
            $model = $this->faker->randomElement($models[$brand]);
            $storage = $this->faker->randomElement(['64GB', '128GB', '256GB']);
            $color = $this->faker->randomElement(['Black', 'White', 'Blue']);
            
            return [
                'type_hp' => "{$brand} {$model} {$storage} {$color}",
            ];
        });
    }

    /**
     * State tanpa foto
     */
    public function withoutPhoto()
    {
        return $this->state(function (array $attributes) {
            return [
                'photo_url' => null,
            ];
        });
    }

    /**
     * State dengan notes khusus
     */
    public function withNotes($notes)
    {
        return $this->state(function (array $attributes) use ($notes) {
            return [
                'notes' => $notes,
            ];
        });
    }
}