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
        Sale::factory()->count(200)->create()->each(function ($sale) {            
            $products = Product::inRandomOrder()->take(rand(1, 5))->get()->unique('id'); // Para cada venta, agregar entre 1 y 5 productos
            
            $total = 0;
            foreach ($products as $product) {
                $quantity = rand(1, 3); // Cada producto tiene una cantidad aleatoria de unidades vendidas por venta
                $price = $product->price;
                
                $sale->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $price
                ]);
                
                $total += $quantity * $price;
            }
            
            // Actualizar el total_amount de la venta
            $sale->update(['total_amount' => $total]);
        });
    }
}
