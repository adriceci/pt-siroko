<?php

namespace Tests\Unit;

use Tests\TestCase;

class WebTest extends TestCase
{
    public function test_it_return_200_when_visit_home_page(): void
    {
        $this->get('/')->assertStatus(200);

    }

    public function test_it_return_200_when_visit_login_page(): void
    {
        $this->get('/login')->assertStatus(200);
    }
}
