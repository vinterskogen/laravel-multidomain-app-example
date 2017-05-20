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
        $this->app['router']->pattern('domain', '.+');
        $this->app['router']->pattern(
            'masterAdminDomain',
            env('MASTER_ADMIN_DOMAIN', 'master.foobar.com')
        );

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapMasterAdminRoutes();
        $this->mapAdminRoutes();
        $this->mapSiteRoutes();
    }

    /**
     * Define the "one.com" routes for the application.
     *
     * @return void
     */
    protected function mapMasterAdminRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web/MasterAdmin.php'));
    }

    /**
     * Define the "two.com" routes for the application.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web/Admin.php'));
    }

    /**
     * Define routes for other domains.
     *
     * @return void
     */
    protected function mapSiteRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web/Site.php'));
    }

    /**
     * Dump routes
     *
     * @return void
     */
    protected function dumpRoutes()
    {
        $routes = [];
        foreach (Route::getRoutes() as $route) {
            $routes[] = $route->uri();
        }
        dd($routes);
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
