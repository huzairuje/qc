<?php

namespace App\Http\Middleware;

use Closure;

class SentinelAuth
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

        if (! \Sentinel::check() ) {
            if ( $request->ajax() || $request->wantsJson() ) {
                return response( 'Unauthorized.', 401 );
            }

            return redirect()->route( 'admin.auth.login' );
        }
        
        return $next($request);
    }
}
