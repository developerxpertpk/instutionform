<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //

    protected $fillable = [
        'country','state','city',
    ];

    public function schools(){
    	return $this->hasOne('App\School','location_id');
    }
}
