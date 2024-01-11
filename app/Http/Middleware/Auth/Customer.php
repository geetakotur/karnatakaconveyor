<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Customer
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
        // dd('Customer Middleware');
        // dd($guard);
        // return $next($request);

        if (Auth::guard($guard)->check()) {
            // Check if user !customer
            // dd(Auth::user());
            if(Auth::user()->isMgmt)
                return redirect('customer.login');

            return $next($request);
        }

        return redirect('customer.login');
    }
}
