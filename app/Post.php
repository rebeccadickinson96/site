<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'date_published', 'published'];
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

    public function addCategories($categories)
    {
        $this->categoryPost()->where('post_id', $this->id)->delete();
        if (!$categories) {
            return false;
        }

        foreach ($categories as $category) {
            if (!$category || !$category['category']) {
                continue;
            }
            CategoryPost::create([
                'post_id'     => $this->id,
                'category_id' => $category['category']
            ]);
        }
        return true;
    }

    public function status()
    {
        if ($this->date_published < Carbon::now() && $this->published == 1) {
            return "Published";
        }

        if ($this->date_published > Carbon::now() && $this->published == 1) {
            return "Scheduled";
        }

        if ($this->published == 0) {
            return "Draft";
        }
        return "Published";
    }

    public function scopeIsPublished($query)
    {
        return $query->where('date_published', '<', Carbon::now())->where('published', 1);
    }

    public function scopeIsScheduled($query)
    {
        return $query->where('date_published', '>', Carbon::now())->where('published', 1);
    }

    public function scopeIsDraft($query)
    {
        return $query->where('published', 0);
    }

    public function scopeFilter($query)
    {
        if ($month = request('month')) {
            $query->whereMonth('date_published', Carbon::parse($month)->month)->isPublished();
        }

        if ($year = request('year')) {
            $query->whereYear('date_published', $year)->isPublished();
        }
        return $query;
    }

    public function scopeUncategorized($query)
    {
        return $query->whereDoesntHave('categories')->isPublished()->orderBy('date_published', 'desc');
    }

    public static function archives()
    {
        if (App::environment('acceptance')) {
            return static::selectRaw("strftime('%m', date_published) as month, strftime('%Y',
                date_published) as year")
                ->isPublished()
                ->groupBy('year', 'month')
                ->orderByRaw('min(date_published) desc')
                ->get();
        }
        return static::selectRaw('year(date_published) year, monthname(date_published) month, count(*) published')
            ->isPublished()
            ->groupBy('year', 'month')
            ->orderByRaw('min(date_published) desc')
            ->get();

    }

    public static function noCategories()
    {
        return static::whereDoesntHave('categories')->isPublished()->get()->count();
    }

    public function transform()
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'body'           => $this->body,
            'date_published' => $this->date_published->format('Y-m-d H:i:s'),
            'published'      => $this->published,
            'published_by'   => $this->User->transform(),
            'tags'           => $this->categories->map(function ($category) {
                return $category->transform();
            }),
            'comments' => $this->comments->map(function ($comment) {
                return $comment->transform();
            })
        ];
    }

}
