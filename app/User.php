<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\MyOwnResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

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
        return $this->hasMany('App\Reportedforum','user_id');
    }

    public function reported_threads(){
        return $this->hasMany('App\Reported_thread','user_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
             $user->school_ratings()->delete();
             $user->bookmarked_schools()->delete();
             $user->forums()->delete();
             $user->threads()->delete();
             $user->reporting_forum()->delete();
             $user->reported_threads()->delete();
             // do the rest of the cleanup...
        });
    }
}
