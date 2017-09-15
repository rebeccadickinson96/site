<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','body', 'user_id', 'commenter_name'];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
