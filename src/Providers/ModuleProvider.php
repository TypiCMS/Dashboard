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

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'dashboard');
        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/dashboard'),
        ], 'views');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'dashboard');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.dashboard'
        );
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations'),
        ], 'migrations');
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Dashboard\Providers\RouteServiceProvider');

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
