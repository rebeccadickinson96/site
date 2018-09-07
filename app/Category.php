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

    public function publishedPosts()
    {
        return $this->belongsToMany('App\Post', 'category_posts')->isPublished();
    }

    //categories with published posts

    public static function allCategories()
    {
        return static::whereHas('publishedPosts')->latest()->get();
    }

    public function transform() {
        return [
            'id' => $this->id,
            'tag' => $this->category
        ];
    }
}
