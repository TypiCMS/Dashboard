<?php

namespace TypiCMS\Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Dashboard\Composers\SidebarViewComposer;
use TypiCMS\Modules\Dashboard\Repositories\EloquentDashboard;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.dashboard'
        );

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'dashboard');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard'),
        ], 'views');

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Dashboard', EloquentDashboard::class);
    }
}
