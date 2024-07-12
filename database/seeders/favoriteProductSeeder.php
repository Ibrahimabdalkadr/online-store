<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class favoriteProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::take(10)->get();
        $users = User::take(5)->get();
        foreach ($users as $user) {
        $numberOfFavorites = fake()->numberBetween(1, 50);
        $products = Product::inRandomOrder()->take($numberOfFavorites)->get();
            $user->favoriteProducts()->saveMany($products);
        }
    }
}
