<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //

   protected $fillable = [
        'school_name', 'school_address','country','state','city','image','location_id','status'
    ];

    protected $hidden = [
         'remember_token',
    ];


}
