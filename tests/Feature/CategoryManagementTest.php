<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function it_can_create_category()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/api/category', [
            'title' => 'Awesome Category'
        ], ['Accept' => 'application/json']);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function it_can_update_category()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/api/category', [
            'title' => 'Awesome Category'
        ], ['Accept' => 'application/json']);

        $response->assertStatus(201);

        $response = $this->json('PUT', '/api/category', [
            'title' => 'New Awesome Category'
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }
}
