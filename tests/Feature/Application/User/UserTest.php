<?php

namespace Tests\Feature\Application\User;

use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_it_visit_page_of_login(): void
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSee('Login');
    }

    public function test_it_return_invalid_email_format(): void
    {

        $payload = [
            'email' => 'admin_siroko.com',
            'password' => '1234567'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(406);
    }

    public function test_it_return_invalid_password(): void
    {

        $payload = [
            'email' => 'admin@siroko.com',
            'password' => '1234567'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(401);
    }

    public function test_it_return_valid_user(): void
    {

        $payload = [
            'email' => 'test@siroko.com',
            'password' => '123456'
        ];

        $response = $this->postJson('/user/auth', $payload);

        $response->assertStatus(200);
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
}
