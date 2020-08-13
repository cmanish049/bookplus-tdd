<?php

namespace Tests;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PublicationResource;
use App\Publication;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create(string $model, array $attributes = [])
    {
        $data = factory("App\\$model")->create($attributes);

        $resource = "App\\Http\\Resources\\" . $model. "Resource";

        return new $resource($data);

        // if ($data instanceof Category)
        //     return new CategoryResource($data);
        // if ($data instanceof Publication)
        //     return new PublicationResource($data);

    }
}
