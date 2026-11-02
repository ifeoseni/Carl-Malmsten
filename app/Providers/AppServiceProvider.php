<?php

namespace App\Providers;

use App\Models\MenuItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Every page using the site layout gets the header/footer menus automatically.
        View::composer('layouts.site', function ($view) {
            $ready = Schema::hasTable('menu_items');
            $view->with('headerMenu', $ready ? MenuItem::at('header')->where('is_active', true)->get() : collect());
            $view->with('footerMenu', $ready ? MenuItem::at('footer')->where('is_active', true)->get() : collect());
        });
    }
}
