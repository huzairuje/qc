<?php

namespace App\Http\Middleware;

use Closure;

class SentinelRedirectIfAuthenticated
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
        if ( \Sentinel::check() ) {
            return redirect('/');
        }
        return $next($request);
    }
}
