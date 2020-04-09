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
        if (Auth::guard($guard)->check()) {
            if (Auth::User()->hasRole('super-admin')) {
                return redirect(RouteServiceProvider::ADMIN);
            } else if(Auth::User()->hasRole('pharmacy')) {
                return redirect(RouteServiceProvider::PHARMACY);
            }  else if(Auth::User()->hasRole('doctor')) {
                return redirect(RouteServiceProvider::DOCTOR);
            }
            else{
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
