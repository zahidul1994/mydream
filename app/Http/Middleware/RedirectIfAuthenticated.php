<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('admin/dashboard');
        }
         if ($guard == "superadmin" && Auth::guard($guard)->check()) {
             return redirect('superadmin/dashboard');

         }
        // if (Auth::guard($guard)->check() && Auth::user()->role->id == 1) {
        //     return redirect()->route('admin.dashboard');
        // }
        if (Auth::guard($guard)->check()) {
            return redirect('/user/udashboard');
        }

        return $next($request);
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        // return $next($request);
    }
}
