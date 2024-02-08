<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Siroko\Domain\Product\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(50)->create();
    }
}
