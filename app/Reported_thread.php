<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reported_thread extends Model
{
	public $timestamps = false;

    public static function boot(){
        // boot
        parent::boot();

        static::creating( function ($model) {
            $model->setCreatedAt($model->freshTimestamp());
        });
    }
	
    public function users(){
        return  $this->belongsTo('App\User','user_id');
    }

    public function threads(){
    	return $this->belongsTo('App\Thread','thread_id');
    }
}
