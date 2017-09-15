<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function addComment($body)
    {

        $this->comments()->create(compact('body'));

        return back();
    }
}

