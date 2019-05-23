<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Sentinel;
class SentinelCheck
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
        if (Sentinel::check())
        {
            return $next($request);
            // User is logged in and assigned to the `$user` variable.
        }
        \Session::put('loginRedirect', \Request::url());
        return \Redirect::route('backend.login');

    }
}
