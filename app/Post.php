<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'date_published'];
    protected $dates = ['date_published'];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_posts');
    }

    public function categoryPost()
    {
        return $this->hasMany('App\CategoryPost');
    }

    public function addComment($body)
    {

        $this->comments()->create(compact('body'));

        return back();
    }

    public function addCategories($categories){
        $this->categoryPost()->where('post_id', $this->id)->delete();
        if(!$categories){
            return false;
        }

        foreach($categories as $category){
            if(!$category || !$category['category']){
                continue;
            }
            CategoryPost::create([
                'post_id' => $this->id,
                'category_id' => $category['category']
            ]);
        }
        return true;
    }

    public function scopeFilter($query)
    {
        if ($month = request('month')) {
            $query->whereMonth('date_published', Carbon::parse($month)->month);
        }

        if ($year = request('year')) {
            $query->whereYear('date_published', $year);
        }
        return $query;
    }

    public static function archives(){
        return static::selectRaw('year(date_published) year, monthname(date_published) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(date_published) desc')
            ->get();
    }

}

