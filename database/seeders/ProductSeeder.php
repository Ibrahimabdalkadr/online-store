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
        $products = [
            [
                'name' => 'Product 1',
                'image' => 'path/to/image1.jpg',
                'description' => 'Description for Product 1',
                'price' => 100.00,
                'new_price' => 90.00,
                'category_id' => 1
            ],
            [
                'name' => 'Product 2',
                'image' => 'path/to/image2.jpg',
                'description' => 'Description for Product 2',
                'price' => 200.00,
                'new_price' => 180.00,
                'category_id' => 2
            ],
            [
                'name' => 'Product 3',
                'image' => 'path/to/image3.jpg',
                'description' => 'Description for Product 3',
                'price' => 300.00,
                'new_price' => 270.00,
                'category_id' => 3
            ],
            [
                'name' => 'Product 4',
                'image' => 'path/to/image4.jpg',
                'description' => 'Description for Product 4',
                'price' => 400.00,
                'new_price' => 360.00,
                'category_id' => 4
            ],
            [
                'name' => 'Product 5',
                'image' => 'path/to/image5.jpg',
                'description' => 'Description for Product 5',
                'price' => 500.00,
                'new_price' => 450.00,
                'category_id' => 4
            ],
            [
                'name' => 'Product 6',
                'image' => 'path/to/image6.jpg',
                'description' => 'Description for Product 6',
                'price' => 600.00,
                'new_price' => 540.00,
                'category_id' => 6
            ],
            [
                'name' => 'Product 7',
                'image' => 'path/to/image7.jpg',
                'description' => 'Description for Product 7',
                'price' => 700.00,
                'new_price' => 630.00,
                'category_id' => 7
            ],
            [
                'name' => 'Product 8',
                'image' => 'path/to/image8.jpg',
                'description' => 'Description for Product 8',
                'price' => 800.00,
                'new_price' => 720.00,
                'category_id' => 8
            ],
            [
                'name' => 'Product 9',
                'image' => 'path/to/image9.jpg',
                'description' => 'Description for Product 9',
                'price' => 900.00,
                'new_price' => 810.00,
                'category_id' => 9
            ],
        ];

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
