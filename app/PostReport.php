<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = ['post_id', 'category', 'description'];

    public function post() {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
