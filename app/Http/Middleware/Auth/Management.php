<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Management
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
        if ($request->expectsJson()) {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        // dd($guard);

        if (Auth::guard($guard)->check()) {
            // Check if user !mgmtuser
            // dd(Auth::user());
            if(!Auth::user()->isMgmt)
                return redirect('mgmt.login');

            return $next($request);
        }

        return redirect('mgmt.login');
    }
}
