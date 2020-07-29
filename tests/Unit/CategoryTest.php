<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function it_can_store_category()
    {
        $this->withoutExceptionHandling();
        Category::create([
            'title' => 'Awesome Title'
        ]);
        $category = Category::first();
        $this->assertEquals('Awesome Title', $category->title);
        $this->assertCount(1, Category::all());
    }
}
