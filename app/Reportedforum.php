<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportedforum extends Model
{
    //


    protected $fillable = [
        'forum_id','user_id','reporting_type','reporting_reason','status',
    ];

    public function forums(){
        return  $this->belongsTo('App\Forum','forum_id');
    }

    public function users(){
        return  $this->belongsTo('App\User','user_id');
    }

}
