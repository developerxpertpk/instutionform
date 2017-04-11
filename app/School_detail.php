<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_detail extends Model
{
    protected $fillable = [
        'school_id','documents','description',
    ];

    public function schools(){
    	return $this->belongsTo('App\School','school_id');
    }
}
