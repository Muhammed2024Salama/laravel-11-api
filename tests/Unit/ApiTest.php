<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_api_returns_a_successful_response(): void
    {
        $response = $this->get('/api');

        $response->assertSimilarJson(['Welcome to Laravel 11 API']);
        $response->assertStatus(200);
    }
}
