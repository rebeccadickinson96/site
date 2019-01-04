<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = ['post_id', 'category', 'description', 'user_id', 'action', 'reviewer_comment', 'review_date'];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
