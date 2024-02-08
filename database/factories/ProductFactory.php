<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Siroko\Domain\Product\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_uuid' => $this->faker->uuid,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'image' => $this->faker->imageUrl(),
            'image_alt' => $this->faker->sentence,
        ];
    }
}
