<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Snacks',
            'Gaseosas',
            'Aguas y Bebidas',
            'Lácteos',
            'Carnes y Embutidos',
            'Frutas y Verduras',
            'Panadería',
            'Cerveza y Licores',
            'Productos de Limpieza',
            'Cuidado Personal',
            'Congelados',
            'Cereales y Granos',
            'Enlatados',
            'Condimentos y Especias',
            'Dulces y Confitería',
            'Productos para Bebés',
            'Mascotas',
            'Productos de Papel',
            'Productos Importados',
            'Productos Veganos',
            'Otros'
        ];
    
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
