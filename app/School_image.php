<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_image extends Model
{
    //
     
    protected $fillable = [
        'image','school_id',
    ];

    public function schools(){
        return $this->belongsTo('App\School','school_id');
    }

}
