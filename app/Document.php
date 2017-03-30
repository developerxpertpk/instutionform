<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
        'school_id','document',
    ];

    public function schools(){
        return $this->belongsTo('App\School','school_id');
    }
}
