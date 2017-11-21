<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'role_permissions');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
