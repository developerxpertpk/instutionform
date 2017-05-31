<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    //
    protected $fillable = [
        'school_id','user_id','title','description','status',
    ];

    public function schools(){
        return  $this->belongsTo('App\School','school_id');
    }

    public function users(){
        return  $this->belongsTo('App\User','user_id');
    }
    public function reported_forum(){
        return  $this->hasMany('App\Reportedforum','forum_id');
    }

    public function forum_likes(){
        return $this->hasMany('App\Forum_likes_dislike','forum_id');
    }
    
    public function threads(){
        return  $this->hasMany('App\Thread','forum_id');
    }    

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($forum) { // before delete() method call this
             $forum->reported_forum()->delete();
             $forum->forum_likes()->delete();
             // do the rest of the cleanup...
        });
    }
}
