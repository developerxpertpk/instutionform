<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Threads_likes_dislike extends Model
{
    public function threads(){
        return  $this->belongsTo('App\Thread','thread_id');
    }
}
