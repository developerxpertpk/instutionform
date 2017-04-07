<?php

namespace App\Http\Middleware;

use Closure;

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
        if($request->ajax()){
        }
        if(Auth::user()->status == 1){

            if($request->ajax()){
               return response('Sorry,you have been blocked by Finder & Forum') 
            }

            return back()->with('status_error','Sorry,you have been blocked by Finder & Forum');
        }
        return $next($request);
    }
}
