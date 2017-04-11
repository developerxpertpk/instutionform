<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //

   protected $fillable = [
        'school_name', 'school_address','location_id','status'
    ];

    protected $hidden = [
         'remember_token',
    ];

     public function locations(){
        return $this->belongsTo('App\Location','location_id');
    }

    public function school_images(){
    	return $this->hasMany('App\School_image','school_id');
    }

    public function school_details(){
        return $this->hasMany('App\School_detail','school_id');
    }

    public function school_ratings(){
        return $this->hasMany('App\School_rating','school_id');
    }
}
