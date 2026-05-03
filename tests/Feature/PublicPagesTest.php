<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_are_accessible(): void
    {
        $this->seed();

        $this->get(route('home'))->assertOk();
        $this->get('/about-us')->assertOk();
        $this->get('/clients')->assertOk();
        $this->get('/products')->assertOk();
    }
}
