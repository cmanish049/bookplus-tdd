<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Publication extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    public static function booted()
    {
        static::creating(function ($publication) {
            $publication->slug = Str::slug($publication->name);
        });

        static::updating(function ($publication) {
            $publication->slug = Str::slug($publication->name);
        });
    }
}
