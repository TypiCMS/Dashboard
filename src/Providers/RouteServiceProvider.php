<?php

namespace TypiCMS\Modules\Dashboard\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Dashboard\Http\Controllers\AdminController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->group(function (Router $router) {
            $router->get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('can:see dashboard');
            $router->get('', [AdminController::class, 'index'])->middleware('can:see dashboard');
        });
    }
}
