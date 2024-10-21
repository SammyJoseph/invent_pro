<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sale_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'total_amount' => 0, // Inicialmente en 0, se calculará después en el seeder
        ];
    }
}
