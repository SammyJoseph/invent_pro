<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'price' => round($this->faker->randomFloat(2, 0.1, 20) * 2, 0) / 2,
            'stock' => $this->faker->numberBetween(20, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
