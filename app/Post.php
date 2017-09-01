<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Post extends Model
{
    protected $fillable = ['title', 'body'];
}

