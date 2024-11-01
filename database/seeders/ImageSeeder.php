<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear solo 2 imágenes (no una por cada producto (para mejorar la performance al ejecutar el seeder))
        $baseImages = Image::factory()->count(10)->make();

        $products = Product::all();

        // Asignar una imagen aleatoria a cada producto (las 2 imágenes se repetirán para los productos)
        foreach ($products as $product) {
            $randomImage = $baseImages->random();

            Image::create([
                'url' => $randomImage->url,
                'imageable_id' => $product->id,
                'imageable_type' => Product::class,
            ]);
        }
    }
}