<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\Request;
use Auth;

use Closure;

class User_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = User::where('email', $request['email'])->with('Role')->get();
        
       
         foreach($role as $userData){
            $userData = $userData;
            }
        // echo "<pre>";
        //print_r($userData);
        // echo  $userData->role->role;
        
             if($userData->role->role == 'user'){
               
                return redirect(route('home'));
             }
             else{
                 return redirect(route('home'));
             }

        return $next($request);
    }
}
