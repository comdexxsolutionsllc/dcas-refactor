<?php

namespace App\Http\Middleware;

use Closure;

class AddAccessControlAllowOriginHeader {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        //$response->headers->set('Access-Control-Allow-Origin', 'X-CSRF-Token');

        return $response;
    }
}
