<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapDriverRoutes();

        $this->mapAgentRoutes();

        $this->mapCashierRoutes();

        $this->mapPassengerRoutes();

        //
    }

    /**
     * Define the "passenger" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapPassengerRoutes()
    {
        Route::group([
            'middleware' => ['web', 'passenger', 'auth:passenger'],
            'prefix' => 'passenger',
            'as' => 'passenger.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/passenger.php');
        });
    }

    /**
     * Define the "cashier" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapCashierRoutes()
    {
        Route::group([
            'middleware' => ['web', 'cashier', 'auth:cashier'],
            'prefix' => 'cashier',
            'as' => 'cashier.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/cashier.php');
        });
    }

    /**
     * Define the "agent" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAgentRoutes()
    {
        Route::group([
            'middleware' => ['web', 'agent', 'auth:agent'],
            'prefix' => 'agent',
            'as' => 'agent.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/agent.php');
        });
    }

    /**
     * Define the "driver" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapDriverRoutes()
    {
        Route::group([
            'middleware' => ['web', 'driver', 'auth:driver'],
            'prefix' => 'driver',
            'as' => 'driver.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/driver.php');
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
