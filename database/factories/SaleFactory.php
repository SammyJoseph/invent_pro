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
            'total_amount' => 0, // Se calculará después en el seeder
            'total_cost' => 0, // Se calculará después en el seeder
            'total_profit' => 0, // Se calculará después en el seeder
            'payment_method' => $this->faker->randomElement(['Efectivo', 'Yape', 'Plin', 'Tarjeta', 'Otro']),
            'notes' => $this->faker->optional(0.3)->sentence(),
        ];
    }
}
