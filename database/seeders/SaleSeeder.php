<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::factory()->count(500)->create()->each(function ($sale) {            
            $products = Product::inRandomOrder()->take(rand(1, 5))->get()->unique('id');
            
            $total_amount = 0;
            $total_cost = 0;

            foreach ($products as $product) {
                $quantity = rand(1, 3);
                $purchase_price = $product->purchase_price;
                $sale_price = $product->sale_price;
                
                $sale->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'purchase_price' => $purchase_price,
                    'sale_price' => $sale_price
                ]);
                
                $total_amount += $quantity * $sale_price;
                $total_cost += $quantity * $purchase_price;
            }
            
            $total_profit = $total_amount - $total_cost;

            $sale->update([
                'total_amount' => $total_amount,
                'total_cost' => $total_cost,
                'total_profit' => $total_profit
            ]);
        });
    }
}
