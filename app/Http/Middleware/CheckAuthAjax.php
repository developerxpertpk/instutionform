<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAuthAjax
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
        if(!Auth::check()){
            return response(400);
        }

        return $next($request);
    }
}
