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
            [
                'name' => 'Clothes',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'Footwear',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'Jewelry',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'Perfume',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'Cosmetics',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'Glasses',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'Bags',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'best sellers',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
            [
                'name' => 'girls t-shirt',
                'icon'=>'http://localhost:8000/public/app/public/category/5435345/svg'
            ],
        ];









        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
