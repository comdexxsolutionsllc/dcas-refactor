<?php

namespace Modules\Internal\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_admin !== 1)
        {
            return redirect('home');
        }

        return $next($request);
    }
}
