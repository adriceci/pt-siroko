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
        $this->call(UserSeeder::class); // Create users
        $this->call(ProductSeeder::class); // Create products
        $this->call(CartSeeder::class); // Create carts | Require products | Require users
    }
}
