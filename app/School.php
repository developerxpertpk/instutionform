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

    public function news(){
        return $this->hasMany('App\School_news','school_id');
    }

    public function school_ratings(){
        return $this->hasMany('App\School_rating','school_id');
    }

    public function bookmarked_schools(){
        return $this->hasMany('App\Bookmarked_school','school_id');
    }

    public function forums(){
            return  $this->hasMany( 'App\Forum','school_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($school) { // before delete() method call this
                // $school->locations()->delete();
                $school->school_images()->delete();
                $school->news()->delete();
                $school->school_ratings()->delete();
                $school->bookmarked_schools()->delete();

                /*$forum=$school->forums();
                echo "<pre>";
                foreach ($forum as $key => $value) {
                    print_r($value->);
                }
                die();
                $forum->reported_forum()->delete();
                $forum->forum_likes()->delete();

                $thread=$forum->threads();
                $thread->thread_likes()->delete();
                $thread->thread_comments()->delete();
                $thread->reported_threads()->delete();*/
                // do the rest of the cleanup...
        });
    }
}
