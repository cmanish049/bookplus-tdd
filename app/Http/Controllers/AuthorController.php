<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store()
    {
        request()->validate(['name' => 'required']);

        $author = Author::create([
            'name' => request('name'),
        ]);

        return response()->json($author, 201);
    }

    public function update(Author $author)
    {
        $author->name = request('name');
        $author->save();
        return response()->json(new AuthorResource($author), 200);
    }
}
