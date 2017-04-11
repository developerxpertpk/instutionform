<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_news extends Model
{
    //


    protected $fillable = [
        'student_id','news_title','news_description','status'
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function schools(){
        return $this->belongsTo('App\School','school_id');
    }
}
