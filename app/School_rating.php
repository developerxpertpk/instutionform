<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_rating extends Model
{
    protected $fillable = [
        'school_id','user_id','ratings','reviews',
    ];

    public function schools(){
        return $this->belongsTo('App\School','school_id');
    }

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
