<?php

namespace Labmanager\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Labmanager\Models\User;

class Administrator
{
    public function handle($request, Closure $next, $guard = 'administrator')
    {
        if (!Auth::guest() && (Auth::user()->hak_akses === 'administrator')) {
            $currentuser = User::where('userakun_id',Auth::user()->id)->first();
            $namauser = $currentuser->nama_user;
            $fotoprofil = ($currentuser->foto) ? $currentuser->foto : 'user.png';
            $role = Auth::user()->hak_akses;

            view()->share(['namauser'=>$namauser,'role'=>$role,'fotoprofil'=>$fotoprofil]);
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->guest('/');
    }
}
