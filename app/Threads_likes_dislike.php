<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Threads_likes_dislike extends Model
{
	/*public function getUpdatedAtColumn() {
    	return null;
	}*/
	public $timestamps = false;

	public static function boot(){
		// boot
		parent::boot();

    	static::creating( function ($model) {
        	$model->setCreatedAt($model->freshTimestamp());
    	});
	}
    

    public function threads(){
        return  $this->belongsTo('App\Thread','thread_id');
    }
}
