<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //

    protected $fillable = [
        'forum_id','user_id','title','description','status',
    ];

    public function forums(){
        return  $this->belongsTo('App\Forum','forum_id');
    }

    public function users(){
        return  $this->belongsTo('App\User','user_id');
    }

    public function thread_likes(){
        return $this->hasMany('App\Threads_likes_dislike','thread_id');
    }

    public function thread_comments(){
        return $this->hasMany('App\Thread_comment','thread_id');
    }

    public function reported_threads(){
        return $this->hasMany('App\Reported_thread','thread_id');
    }
}
