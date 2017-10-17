<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category', 'description'];

    public static function allCategories(){
        return static::latest()->get();
    }
}
