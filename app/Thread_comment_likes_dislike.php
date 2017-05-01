<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread_comment_likes_dislike extends Model
{
	public $timestamps = false;

	public static function boot(){
		// boot
		parent::boot();

    	static::creating( function ($model) {
        	$model->setCreatedAt($model->freshTimestamp());
    	});
	}
	
    public function thread_comment(){
        return  $this->belongsTo('App\Thread_comment','thread_comment_id');
    }
}
