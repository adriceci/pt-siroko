<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Siroko\Domain\Cart\Cart;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::factory(10)->create();
    }
}
