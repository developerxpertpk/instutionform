<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // defining a  relation between Roles and user table 
    public function user()
    {
        return $this->hasMany('App\User', 'role_id');
    }
}
