<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum_likes_dislike extends Model
{
    public $timestamps = false;

	public static function boot(){
		// boot
		parent::boot();

    	static::creating( function ($model) {
        	$model->setCreatedAt($model->freshTimestamp());
    	});
	}

	public function forums(){
        return  $this->belongsTo('App\Forum','forum_id');
    }
}
