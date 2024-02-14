<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Siroko\Domain\Order\OrderStatus;

class OrderStatusFactory extends Factory
{
    protected $model = OrderStatus::class;

    public function definition(): array
    {
        return [
            'name' => '',
            'description' => '',
            'created_at' => $this->faker->dateTimeBetween('-3 years'),
            'updated_at' => $this->faker->dateTimeBetween('-3 years')
        ];
    }
}
