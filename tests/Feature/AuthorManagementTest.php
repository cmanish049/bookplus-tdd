<?php

namespace Tests\Feature;

use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function author_can_be_created()
    {
        $response = $this->json(
            'POST',
            'api/authors', [
                'name' => 'New Author',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'name', 'slug'
            ])
            ->assertJsonFragment([
                'name' => 'New Author',
                'slug' => Str::slug('New Author'),
            ]);
        $this->assertCount(1, Author::all());
    }

    /** @test */
    public function author_name_is_required()
    {
        $this->post('/api/authors', [])->assertSessionHasErrors('name');
    }
    /** @test */
    public function author_can_be_updated()
    {
        $this->withOutExceptionHandling();

        $author = $this->create('Author');

        $this->assertCount(1, Author::all());

        $response = $this->json(
            'PUT',
            $author->path(),
            [
                'name' => 'Updated Author',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(200)

            ->assertJsonStructure([
                'id', 'name', 'slug'
            ])

            ->assertJsonFragment([
                'name' => 'Updated Author',
                'slug' => Str::slug('Updated Author'),
            ]);

        $this->assertCount(1, Author::all());
    }
}
