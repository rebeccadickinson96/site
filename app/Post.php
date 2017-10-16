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



    public function addComment($body)
    {

        $this->comments()->create(compact('body'));

        return back();
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

}

