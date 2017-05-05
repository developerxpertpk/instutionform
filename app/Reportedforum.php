<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportedforum extends Model
{
    public $timestamps = false;

    public static function boot(){
        // boot
        parent::boot();

        static::creating( function ($model) {
            $model->setCreatedAt($model->freshTimestamp());
        });
    }

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
