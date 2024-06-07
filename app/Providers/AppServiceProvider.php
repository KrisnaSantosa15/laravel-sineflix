<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Add genres to layouts/partials/users/navbar.blade.php
        View::composer('layouts.partials.users.navbar', function ($view) {
            $view->with('genres', \App\Models\Genre::all());
        });

        // Add log activity to layouts/partials/navbar-dashboard.blade.php
        View::composer('layouts.partials.navbar-dashboard', function ($view) {
            $view->with('logActivities', \App\Models\LogActivity::orderBy('id', 'desc')->take(5)->get());
        });
    }
}
