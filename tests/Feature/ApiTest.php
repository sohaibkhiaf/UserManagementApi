<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_health_endpoint()
    {
        $response = $this->getJson('/api/health');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'ok'
            ]);
    }

    public function test_database_connection()
    {
        $response = $this->getJson('/api/connectivity');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }
}
