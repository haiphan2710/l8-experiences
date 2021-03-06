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
    public const HOME = '/home';

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
            $this->mapWebRoutes();
            $this->mapAdminRoutes();
            $this->mapApiV1Routes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(180);
        });
    }

    /**
     * Admin Routes
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->name('admin.')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Web Routes
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace . '\Portal')
            ->group(base_path('routes/web.php'));
    }

    /**
     * API Routes
     */
    protected function mapApiV1Routes()
    {
        Route::prefix('admin/api/v1')
            ->middleware('api')
            ->namespace($this->namespace . '\Api\Admin')
            ->group(base_path('routes/api/v1/admin.php'));

        Route::prefix('portal/api/v1')
            ->middleware('api')
            ->namespace($this->namespace . '\Api\Portal')
            ->group(base_path('routes/api/v1/portal.php'));
    }
}
