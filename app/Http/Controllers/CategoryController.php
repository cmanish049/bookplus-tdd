<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
        ]);
        $category = Category::create($data);
        return response()->json(['category' => $category], 201);
    }
}
