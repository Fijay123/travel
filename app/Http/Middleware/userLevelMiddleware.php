<?php

namespace App\Http\Middleware;
Use App\User;
use Auth;

use Closure;

class userLevelMiddleware
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
       // $user = Auth::user();

        if($request->user()->level != 1 )
        {
           abort(403);
        }

        return $next($request);
    }
}
