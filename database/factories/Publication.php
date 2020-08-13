<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publication;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Publication::class, function (Faker $faker) {
    return [
        'name' => $name =  Str::random(10),
        'slug' => Str::slug($name),
    ];
});
