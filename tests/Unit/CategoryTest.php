<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;
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
            'title' => $title = 'Awesome Title',
            'slug' => Str::slug($title),
        ]);
        $category = Category::first();
        $this->assertEquals($title, $category->title);
        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function it_can_edit_category()
    {
        $this->withoutExceptionHandling();
        Category::create([
            'title' => $title = 'Awesome Title',
            'slug' => Str::slug($title),
        ]);
        $category = Category::first();

        $category->title = $title. '_uppdated';
        $category->slug = Str::slug($title. '_uppdated');
        $category->save();

        $this->assertEquals($title. '_uppdated', $category->title);
        $this->assertEquals(Str::slug($title. '_uppdated'), $category->slug);
        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function category_has_path()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $this->assertEquals('/api/categories/'. $category->id, $category->path());
    }
}
