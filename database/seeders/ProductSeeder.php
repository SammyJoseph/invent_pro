<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(100)->create()->each(function ($product) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->get();
            $product->categories()->attach($categories);
        });
    }
}
