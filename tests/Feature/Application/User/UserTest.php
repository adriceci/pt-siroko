<?php

namespace Tests\Feature\Application\User;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_it_return_200_when_user_is_valid(): void
    {

        $payload = [
            'email' => 'test@siroko.com',
            'password' => '123456'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(200);
    }

    public function test_it_return_401_when_incorrect_password(): void
    {

        $payload = [
            'email' => 'admin@siroko.com',
            'password' => '1234567'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(401);
    }

    public function test_it_return_404_when_user_not_found(): void
    {
        $payload = [
            'email' => 'adrian@siroko.com',
            'password' => '123456'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(404);
    }


    public function test_it_return_406_when_invalid_email_format(): void
    {

        $payload = [
            'email' => 'admin_siroko.com',
            'password' => '1234567'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(406);
    }

}
