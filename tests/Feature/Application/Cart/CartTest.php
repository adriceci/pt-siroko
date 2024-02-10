<?php

declare(strict_types=1);

namespace Tests\Feature\Application\Cart;

use Siroko\Domain\User\User;
use Tests\TestCase;

final class CartTest extends TestCase
{
    public function test_it_should_call_cart_create_without_auth_user(): void
    {
        $response = $this->postJson('/cart', []);

        $response->assertStatus(401);
    }

    public function test_it_should_call_cart_create_with_auth_user(): void
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/cart', []);

        $response->assertStatus(200);
    }
}
