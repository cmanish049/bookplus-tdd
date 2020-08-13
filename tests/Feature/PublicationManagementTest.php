<?php

namespace Tests\Feature;

use App\Http\Controllers\PublicationController;
use App\Publication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
class PublicationManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function publication_can_be_created()
    {
        $this->withOutExceptionHandling();

        $response = $this->json('POST', '/api/publications', [
            'name' => $name = 'New Publication'
        ], ['Accept' => 'application/json']);

        $response->assertCreated()
            ->assertJsonStructure([
                'id', 'name', 'slug', 'created_at'
            ]);
        $this->assertDatabaseHas('publications', [
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }

    /** @test */
    public function publication_can_be_updated()
    {
        $this->withOutExceptionHandling();

        $publication = $this->create('Publication');
        $response = $this->json('PUT', '/api/publications/'. $publication->id, [
            'name' => $name = 'updated publication'
        ], ['Accept' => 'application/json']);

        $response->assertOk()
            ->assertJsonFragment([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
    }

    /** @test */
    public function publication_can_be_deleted()
    {
        // $this->withoutExceptionHandling();

        $this->json('POST', '/api/publications', [
            'name' => 'Awesome Publications'
        ], ['Accept' => 'application/json']);

        $publication = Publication::first();

        $response = $this->json('DELETE', '/api/publications/'. $publication->id);
        $response->assertNoContent();
        $this->assertSoftDeleted($publication);

    }

    /** @test */
    public function publication_can_be_read()
    {
        $this->withoutExceptionHandling();

        $publication = $this->create('Publication');

        $response = $this->json('GET', 'api/publications/'. $publication->id);
        $response->assertOk();
        $this->assertCount(1, Publication::all());
    }

    /** @test */
    public function it_shows_404_if_publication_doesnot_exist()
    {
        $response = $this->json('GET', 'api/publications/-1', ['Accept' => 'application/json']);
        $response->assertNotFound();
    }

    /** @test */
    public function publication_name_is_required()
    {
        $this->post('api/publications', [])
            ->assertSessionHasErrors('name');
    }
}
