<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','body', 'user_id', 'commenter_name'];

    public function post(){
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
