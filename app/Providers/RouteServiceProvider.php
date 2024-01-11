<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // Dashboard Routes
            $this->setupMgmtDashboardRoutes();
            $this->setupCustomerDashboardRoutes();
            $this->setupDashboardRoutes();

            // Home Routes
            $this->setupHomeRoutes();
        });
    }

    // Website home
    protected function setupHomeRoutes(){
        // Route::prefix('api')
        //     ->middleware('api')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/home/api.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/home/web.php'));
    }

    // Dashboard
    protected function setupDashboardRoutes(){
        // Route::prefix('dashboard/api')
        //     ->middleware('api')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/dashboard/api.php'));

        $val=Route::middleware('web')
            ->prefix('dashboard')
            ->namespace($this->namespace)
            ->group(base_path('routes/dashboard/web.php'));
    }

    // Management Dashboard
    protected function setupMgmtDashboardRoutes(){
        // Route::prefix('dashboard/mgmt/api')
        //     ->middleware('api')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/dashboard/mgmt/api.php'));

        Route::middleware('web')
            ->prefix('dashboard/mgmt')
            ->namespace($this->namespace)
            ->group(base_path('routes/dashboard/mgmt/web.php'));
    }

    // Customer Dashboard
    protected function setupCustomerDashboardRoutes(){
        // Route::prefix('dashboard/customer/api')
        //     ->middleware('api')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/dashboard/customer/api.php'));

        Route::middleware('web')
            ->prefix('dashboard/customer')
            ->namespace($this->namespace)
            ->group(base_path('routes/dashboard/customer/web.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
