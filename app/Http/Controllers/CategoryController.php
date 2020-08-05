<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
        ]);
        $category = Category::create(array_merge($data, ['slug' => Str::slug(request('title'))]));
        return response()->json(new CategoryResource($category), 201);
    }
    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category), 200);
    }

    public function update(Category $category)
    {
        $category->title = request('title');
        $category->slug = Str::slug(request('title'));
        $category->save();
        return response()->json(new CategoryResource($category), 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
