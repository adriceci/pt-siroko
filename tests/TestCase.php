<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Siroko\Domain\User\User;
use Siroko\Shared\Uuid;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        User::create([
            'user_uuid' => Uuid::random()->value(),
            'name' => 'Test',
            'email' => 'test@siroko.com',
            'password' => '123456',
        ]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
