<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Flash;

class SentinelHasAcess
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
        if ( $user = \Sentinel::check() ) {
            $member = User::find($user->id);
            $routeName = $request->route()->action['as'];
            if( ! $member->isAdmin()) {
                if ($routeName != 'home.index' && $routeName != 'users.profile') {
                    if ( ! \Sentinel::hasAccess( $routeName ) ) {
                        Flash::overlay('Anda Tidak Punya Akses,hubungi Admin!', 'Notification');
                        return redirect()->route( 'home.index' );
                    }
                }
            }
        return $next($request);
    } else {
            return redirect()->route( 'admin.auth.login' );
        }
}
