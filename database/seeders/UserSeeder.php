<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0;$i < 20; $i++){
            User::create([
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'email' => fake()->email(),
                'password' =>  Hash::make(123456),

            ]);
        }
        User::create([
            'first_name' => 'iepo',
            'last_name' => 'iep',
            'email' => 'msfiepo@gmail.com',
            'password' =>  Hash::make(123456),
            'role'=>RoleEnum::ADMIN->value
        ]);
    }
}
