<?php

namespace App\Http\Middleware;

use Closure;

class CheckifUserIsAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {


        if (checkifuserisauthentcated()) {
            return $next($request);
        }

        return redirect('/');
    }

}
