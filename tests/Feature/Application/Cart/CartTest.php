<?php

declare(strict_types=1);

namespace Tests\Feature\Application\Cart;

use Siroko\Domain\Cart\Cart;
use Siroko\Domain\Product\Product;
use Siroko\Domain\User\User;
use Siroko\Shared\Uuid;
use Tests\TestCase;

final class CartTest extends TestCase
{
    public function test_it_return_200_when_cart_create_with_auth_user(): void
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/cart', []);

        $response->assertStatus(200);
    }

    public function test_it_return_401_when_try_cart_create_without_auth_user(): void
    {
        $response = $this->postJson('/cart', []);

        $response->assertStatus(401);
    }

    public function test_it_return_200_when_found_cart(): void
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create();

        $response = $this->actingAs($user)->getJson('/cart/' . $cart->getCartUuid());

        $response->assertStatus(200);
    }

    public function test_it_return_404_when_not_found_cart(): void
    {
        $user = User::factory()->create();
        $cartUuid = Uuid::random()->value();

        $response = $this->actingAs($user)->getJson('/cart/' . $cartUuid);

        $response->assertStatus(404);
    }

    public function test_it_return_200_when_cart_update_with_auth_user(): void
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create();

        $product = Product::factory()->create();

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => $user->getUserUuid(),
            'products' => json_encode([
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 1,
                    "product_uuid" => $product->getProductUuid()
                ]
            ]),
            'ordered' => false
        ];

        $response = $this->actingAs($user)->putJson('/cart', $payload);

        $response->assertStatus(200);
    }

    public function test_it_return_404_when_cart_update_without_auth_user(): void
    {
        $cart = Cart::factory()->create();

        $product = Product::factory()->create();

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => Uuid::random()->value(),
            'products' => json_encode([
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 1,
                    "product_uuid" => $product->getProductUuid()
                ]
            ]),
            'ordered' => false
        ];

        $response = $this->putJson('/cart', $payload);

        $response->assertStatus(401);
    }

    public function test_it_return_200_when_remove_product_from_cart_with_auth_user(): void
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create();

        $product = Product::factory()->create();

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => $user->getUserUuid(),
            'products' => json_encode([
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 1,
                    "product_uuid" => $product->getProductUuid()
                ]
            ]),
            'ordered' => false
        ];

        $response = $this->actingAs($user)->putJson('/cart', $payload);

        $response->assertStatus(200);

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => $user->getUserUuid(),
            'products' => json_encode([]),
            'ordered' => false
        ];

        $response = $this->actingAs($user)->putJson('/cart', $payload);

        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/cart/' . $cart->getCartUuid());

        $response->assertStatus(200);
        $content = $response->json();
        $this->assertEmpty($content['products']);
    }

    public function test_it_return_404_when_remove_product_from_cart_without_auth_user(): void
    {
        $cart = Cart::factory()->create();

        $product = Product::factory()->create();

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => Uuid::random()->value(),
            'products' => [
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 1,
                    "product_uuid" => $product->getProductUuid()
                ]
            ],
            'ordered' => false
        ];

        $response = $this->putJson('/cart', $payload);

        $response->assertStatus(401);
    }

    public function test_it_return_200_when_cart_save_with_auth_user(): void
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create();

        $product = Product::factory()->create();

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => $user->getUserUuid(),
            'products' => json_encode([
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 1,
                    "product_uuid" => $product->getProductUuid()
                ]
            ]),
            'ordered' => false
        ];

        $response = $this->actingAs($user)->putJson('/cart', $payload);

        $response->assertStatus(200);


        $response = $this->actingAs($user)->get('/cart/' . $cart->getCartUuid());

        $response->assertStatus(200);
        $content = $response->json();

        $this->assertNotEmpty($content['products']);
    }

    public function test_it_return_200_when_cart_have_two_product_with_3_quantity_and_total_are_6(): void
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create();

        $product = Product::factory()->create();

        $payload = [
            'cart_id' => $cart->getCartUuid(),
            'user_id' => $user->getUserUuid(),
            'products' => json_encode([
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 3,
                    "product_uuid" => $product->getProductUuid()
                ],
                [
                    "name" => $product->getName(),
                    "image" => $product->getImage(),
                    "price" => $product->getPrice(),
                    "quantity" => 3,
                    "product_uuid" => $product->getProductUuid()
                ]
            ]),
            'ordered' => false
        ];

        $response = $this->actingAs($user)->putJson('/cart', $payload);

        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/cart/' . $cart->getCartUuid() . '/items');

        $response->assertStatus(200);
        $content = $response->json();

        $this->assertNotEmpty($content['products']);
        $this->assertEquals(6, $content['total']);
    }

}
