<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Sam',
            'email' => 'sam@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@inventpro.online',
        ]);

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ImageSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
