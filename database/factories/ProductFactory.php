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
        $purchase_price = max(0.10, round($this->faker->randomFloat(1, 0.1, 7.0) * 2, 1) / 2); // entre 0.1 y 7.0 soles
        $markup_percentage = $this->faker->randomElement([1.1, 1.2, 1.3]); // 10%, 20%, o 30% de aumento

        return [
            'name' => $this->faker->words(3, true),
            'net_content' => $this->faker->randomFloat(2, 0.1, 10.0),
            'unit_of_measure' => $this->faker->randomElement(['kg', 'l', 'ml', 'g', 'oz']),
            'description' => $this->faker->sentence(),
            'purchase_price' => $purchase_price,
            'sale_price' => round($purchase_price * $markup_percentage * 10, 0) / 10,
            'stock' => $this->faker->numberBetween(20, 200),
            'barcode' => $this->faker->ean13(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
