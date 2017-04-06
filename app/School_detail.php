<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_detail extends Model
{
    protected $fillable = [
        'school_id','documents','description',
    ];

    public function school(){
    	return $this->belongsTo('App\School','school_id');
    }
}
