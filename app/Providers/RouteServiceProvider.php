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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // Add this line for debugging
        $this->app->booted(function () {
            $this->dumpRoutes();
        });

        // Simplified rate limiter using only IP
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(120)->by($request->ip());
        });

        $this->routes(function () {
            // API Routes - no auth required
            Route::middleware('api')
                ->group(base_path('routes/api.php'));

            // Web Routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    // Add this method for debugging
    protected function dumpRoutes()
    {
        $routes = Route::getRoutes();
        $routeList = [];
        
        foreach ($routes as $route) {
            $routeList[] = [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName()
            ];
        }
        
        file_put_contents(
            storage_path('logs/routes.json'),
            json_encode($routeList, JSON_PRETTY_PRINT)
        );
    }
} 