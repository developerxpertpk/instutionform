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

}
