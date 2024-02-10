<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Product\Product;
use Siroko\Domain\User\User;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {

        $products = Product::all()->random(3)->toArray();
        $amount = 0;

        foreach ($products as $key => $product) {
            $products[$key] = [
                'product_uuid' => $product['product_uuid'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $this->faker->numberBetween(1, 10),
                'image' => $product['image']
            ];

            $amount += $products[$key]['price'] * $products[$key]['quantity'];
        }

        return [
            'cart_uuid' => $this->faker->uuid(),
            'user_id' => User::all()->random(),
            'products' => json_encode($products),
            'amount' => $amount,
            'ordered' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-3 years'),
            'updated_at' => $this->faker->dateTimeBetween('-3 years')
        ];
    }
}
