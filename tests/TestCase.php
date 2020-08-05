<?php

namespace Tests;

use App\Http\Resources\CategoryResource;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create(string $model, array $attributes = [])
    {
        $data = factory("App\\$model")->create($attributes);

        return new CategoryResource($data);
    }
}
