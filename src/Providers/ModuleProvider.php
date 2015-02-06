<?php
namespace TypiCMS\Modules\Dashboard\Providers;

use Config;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Lang;
use TypiCMS\Modules\Dashboard\Repositories\CacheDecorator;
use TypiCMS\Modules\Dashboard\Repositories\EloquentDashboard;
use TypiCMS\Services\Cache\LaravelCache;
use View;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Bring in the routes
        require __DIR__ . '/../routes.php';

        // Add dirs
        View::addNamespace('dashboard', __DIR__ . '/../views/');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'dashboard');
        $this->publishes([
            __DIR__ . '/../config/' => config_path('typicms/dashboard'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations'),
        ], 'migrations');
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Dashboard\Composers\SideBarViewComposer');

        $app->bind('TypiCMS\Modules\Dashboard\Repositories\DashboardInterface', function (Application $app) {
            $repository = new EloquentDashboard();
            if (! Config::get('app.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'dashboard', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
