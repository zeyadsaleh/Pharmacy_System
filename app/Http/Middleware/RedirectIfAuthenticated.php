<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

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
            if ($guard == "admins" && Auth::guard('admins')->check()) {
                return redirect('/admin');
            }

            if (Auth::guard('admins')->check()) {
                return redirect('/admin');
            }

            return $next($request);
        }
}
