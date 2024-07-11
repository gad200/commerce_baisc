<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(100)->create();
         \App\Models\Seller::factory(100)->create();
         \App\Models\Category::factory(100)->create();
         \App\Models\ProductVariation::factory(100)->create(); // It is already creates a seller to each row
         \App\Models\Product::factory(100)->create(); // It is already creates a seller to each product
         \App\Models\ProductImage::factory(100)->create(); // It is already creates a product to each image
          \App\Models\Order::factory(100)->create(); // It is already creates a User to each row

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
