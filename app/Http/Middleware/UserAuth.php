<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
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
        // dd(Auth::user());
        // dd(Auth::user()->guard);
        // dd($guard);

        // if (Auth::user() && $guard != Auth::user()->guard) {
        //     return redirect()->route('dashboard.home');
        // }

        if (Auth::guard($guard)->check()) {

            // Authorized User
            return $next($request);
        }

        // Not Logged in
        if ($request->expectsJson()) {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        switch ($guard) {
            case 'mgmt':
                return redirect()->route('mgmt.login');

            case 'customer':
                return redirect()->route('customer.login');
        }

        return redirect()->route('dashboard.home');
    }
}
