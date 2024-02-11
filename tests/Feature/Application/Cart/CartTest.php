<?php

declare(strict_types=1);

namespace Tests\Feature\Application\Cart;

use Siroko\Domain\Cart\Cart;
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

        $response = $this->actingAs($user)->getJson('/cart/' . $cart->uuid);

        $response->assertStatus(200);
    }

    public function test_it_return_404_when_not_found_cart(): void
    {
        $user = User::factory()->create();
        $cartUuid = Uuid::random()->value();

        $response = $this->actingAs($user)->getJson('/cart/' . $cartUuid);

        $response->assertStatus(404);
    }

}
