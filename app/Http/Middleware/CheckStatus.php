<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckStatus
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
        // die('a');
        /*Getting Route method*/
        $method=$request->method();

        /*For GET method*/
        if($method == 'GET'){

            /*Check whether request is made by ajax*/
            if($request->ajax()){

                /*Check whether user is blocked*/
                if(Auth::user()->status == 1){
                    return response(500);
                }
                return $next($request);
            }
            return $next($request);
        }


        /*If request is made by login*/
        if($request->has('email') && $request->has('password')){

            if( Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')]) ){

                if(Auth::user()->status == 1){

                    Auth::logout();
                    return redirect('access_denied')->with('status_error','Sorry,you have been blocked by Finder & Forum');
                }
                Auth::logout();
                return $next($request);

            }
            return $next($request);
        }

        return $next($request);
    }
}
