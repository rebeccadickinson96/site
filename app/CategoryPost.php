<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $fillable = ['post_id', 'category_id'];
    public $timestamps = false;
}
