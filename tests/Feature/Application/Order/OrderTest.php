<?php

declare(strict_types=1);

namespace Tests\Feature\Application\Order;

use Siroko\Domain\Cart\Cart;
use Siroko\Domain\User\User;
use Siroko\Shared\Uuid;
use Tests\TestCase;

final class OrderTest extends TestCase
{

    public function test_it_return_200_when_order_is_created(): void
    {
        $user = User::all()->random();
        $cart = Cart::factory()->create(['ordered' => 0]);

        $response = $this->actingAs($user)->postJson('/cart/' . $cart->getCartUuid() . '/checkout');

        $response->assertStatus(200);
    }

    public function test_it_return_400_when_order_is_not_created(): void
    {
        $user = User::all()->random();
        $cart = Cart::factory()->create(['ordered' => 1]);

        $response = $this->actingAs($user)->postJson('/cart/' . $cart->getCartUuid() . '/checkout');

        $response->assertStatus(400);
    }

    public function test_it_return_401_when_user_is_not_authenticated(): void
    {
        $cart = Cart::factory()->create(['ordered' => 0]);

        $response = $this->postJson('/cart/' . $cart->getCartUuid() . '/checkout');

        $response->assertStatus(401);
    }

    public function test_it_return_404_when_cart_is_not_found(): void
    {
        $user = User::all()->random();
        $cart = Uuid::random()->value();

        $response = $this->actingAs($user)->postJson('/cart/' . $cart . '/checkout');

        $response->assertStatus(404);
    }

}
