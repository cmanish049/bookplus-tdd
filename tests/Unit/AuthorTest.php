<?php

namespace Tests\Unit;

use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function author_model_has_path()
    {
        $author = factory(Author::class)->create();

        $this->assertEquals('/api/authors/'. $author->id, $author->path());
    }
}
