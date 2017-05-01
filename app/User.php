<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname','email','password','gender','image','address','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

 // inverse relationship 
    public function role()
    {
        return $this->belongsTo('App\Role' ,'role_id');
    }

    public function school_ratings(){
        return $this->hasMany('App\School_rating','user_id');
    }

    public function bookmarked_schools(){
        return $this->hasMany('App\Bookmarked_school','user_id');
    }
    // public function findForPassport($identifier) {
    //  return User::orWhere(‘email’, $identifier)->where(‘activity’, 1)->first();
    // }
    public function forums(){
        return $this->hasMany('App\Forum','user_id');
    }

    public function threads(){
        return $this->hasMany('App\Thread','user_id');
    }

    public function reporting_forum(){
        return $this->hasMany('App\Reporting_forum','user_id');
    }

    public function reported_threads(){
        return $this->hasMany('App\Reported_thread','user_id');
    }


}
