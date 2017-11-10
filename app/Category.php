<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category', 'description'];

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'category_posts');
    }

    public static function allCategories(){
        return static::whereHas('posts')->latest()->get();
    }

    public function getRouteKeyName()
    {
        return 'category';
    }
}
