<?php

namespace TypiCMS\Modules\Dashboard\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Dashboard\Composers\SidebarViewComposer;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.dashboard');

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'dashboard');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/dashboard'),
        ], 'views');

        View::composer('core::admin._sidebar', SidebarViewComposer::class);
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
