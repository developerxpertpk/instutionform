<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\Request;
use Auth;
use Closure;


class Admin
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

         // print_r($request['email']);
        // extracting email from login amd role from role table .when we use where we need to use get 

         $role = User::where('email', $request['email'])->with('Role')->get();
        
       
         foreach($role as $userData){
            $userData = $userData;
            }
        // echo "<pre>";
        //print_r($userData);
        // echo  $userData->role->role;
        
             if($userData->role->role == 'admin'){
                
                return  redirect(route('admin.dashboard'));
             }
             else{
                
                 return redirect(route('login'));
             }

              return $next($request);

        /*User::find(Auth::user()->id)->role->role
        return $next($request);

            if(\Auth::user()->role->role =='admin') {

             return redirect('admin.dashboard');
            }
         return $next($request);*/
    }
}
