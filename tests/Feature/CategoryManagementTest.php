<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

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
            'title' => $title = 'Awesome Category',
        ], ['Accept' => 'application/json']);

        $response->assertJsonStructure([
            'id', 'title', 'slug'
        ])->assertStatus(201);

        $this->assertDatabaseHas('categories', [
            'title' => $title,
            'slug' => Str::slug($title),
        ]);
    }

    /**
     * @test
     */
    public function it_can_read_category()
    {
        $this->withoutExceptionHandling();
        $category = $this->create('Category');
        $response = $this->json('GET', 'api/category/'. $category->id, ['Accept' => 'application/json']);
        $response->assertOk()->assertJsonStructure([
            'id', 'title', 'slug'
        ]);
    }

    /**
     * @test
     */
    public function it_can_update_category()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/api/category', [
            'title' => 'Awesome Category'
        ], ['Accept' => 'application/json']);

        $category = Category::first();

        $response = $this->json('PUT', '/api/category/'. $category->id, [
            'title' => $title = $category->title. '_updated'
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertExactJson([
            'id' => $category->id,
            'title' => $title,
            'slug' => Str::slug($title)
        ]);
        $this->assertEquals($title, $category->fresh()->title);
        $this->assertEquals(Str::slug($title), $category->fresh()->slug);
    }

    /** @test */
    public function it_can_destroy_category()
    {

        $this->withoutExceptionHandling();

        $this->json('POST', '/api/category', [
            'title' => 'Awesome Category'
        ], ['Accept' => 'application/json']);

        $category = Category::first();

        $response = $this->json('DELETE', '/api/category/'. $category->id);
        $response->assertNoContent()->assertSee(null);
        $this->assertEquals('Awesome Title', $category->fresh()->title);
        $this->assertSoftDeleted($category);
    }

    /** @test */
    public function it_shows_404_if_category_doesnot_exist()
    {
        $response = $this->json('GET', 'api/category/-1', ['Accept' => 'application/json']);
        $response->assertNotFound();
    }
}
