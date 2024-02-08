<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Product\Product;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'cart_uuid' => $this->faker->uuid(),
            'user_id' => User::all()->random(),
            'product_id' => Product::all()->random(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->randomFloat(2, 1, 100),
            'created_at' => $this->faker->dateTimeBetween('-3 years'),
            'updated_at' => $this->faker->dateTimeBetween('-3 years')
        ];
    }
}
