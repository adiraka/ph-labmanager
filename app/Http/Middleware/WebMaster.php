<?php

namespace Labmanager\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WebMaster
{
    public function handle($request, Closure $next, $guard = 'webmaster')
    {
        if (!Auth::guest() && (Auth::user()->hak_akses === 'webmaster')) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->guest('/');
    }
}
