<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Siroko\Domain\Order\OrderStatus;

class
OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::factory()
            ->count(6)
            ->state(
                new Sequence(
                    ['name' => 'PENDING', 'description' => 'The order is pending'],
                    ['name' => 'PROCESSING', 'description' => 'The order is processing'],
                    ['name' => 'COMPLETED', 'description' => 'The order is completed'],
                    ['name' => 'CANCELLED', 'description' => 'The order is cancelled'],
                    ['name' => 'REFUNDED', 'description' => 'The order is refunded'],
                    ['name' => 'FAILED', 'description' => 'The order has failed'],
                )
            )
            ->create();
    }
}
