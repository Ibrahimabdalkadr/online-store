<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::take(5)->get();
        $products = Product::take(5)->get();

        for($i = 1 ;$i <= 4 ; $i++) {

            $order = Order::create([
                'user_id' => $user[$i]->id,
            ]);
            $order->products()->attach($products[$i]->id);
        }
    }
}
