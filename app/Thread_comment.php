<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread_comment extends Model
{
    const UPDATED_AT = 'modified_at';

    public function thread(){
        return  $this->belongsTo('App\Thread','thread_id');
    }

    public function users(){
        return  $this->belongsTo('App\User','user_id');
    }

    public function thread_comment_likes_dislikes(){
    	return $this->hasMany('App\Thread_comment_likes_dislike','thread_comment_id');
    }
}
