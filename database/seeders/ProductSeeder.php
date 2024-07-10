<?php

namespace Database\Seeders;

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
        for ($i = 0; $i < 50 ;$i++) {
            Product::create(            [
                'name' => fake()->text(100),
                'image' => fake()->filePath(),
                'description' => fake()->text(500),
                'price' => fake()->numberBetween(100, 1000),
                'new_price' => fake()->numberBetween(100, 1000),
                'category_id' => fake()->numberBetween(1, 9),
                'rate'=>fake()->numberBetween(1, 5),
                'quantity'=>fake()->numberBetween(1, 1000),
            ]);
        }
    }
}
