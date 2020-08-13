<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Author extends Model
{
    protected $fillable = ['name', 'author'];

    public static function booted()
    {
        static::creating(function($author) {
            $author->slug = Str::slug($author->name);
        });

        static::updating(function ($author) {
            $author->slug = Str::slug($author->name);
        });
    }

    public function path()
    {
        return "/api/authors/{$this->id}";
    }
}
