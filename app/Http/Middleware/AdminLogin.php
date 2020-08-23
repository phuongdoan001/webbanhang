<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class AdminLogin
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
        if (Auth::check()) {
             if (Auth::user()->hasAnyRoles(['admin','author','user'])) {
                return $next($request);
            }else{
                return Redirect::to('dashboard');
            }
        }else{
            return Redirect::to('authlogin');
        }
    }
}
