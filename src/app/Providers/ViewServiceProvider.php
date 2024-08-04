<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        // Share copyright variable
        $current_year = Carbon::now()->year;
        View::share(
            'copyright', __("&copy; Copyright :years Crocus Studio CMS. All Rights Reserved.",
                ['years' => ($current_year == 2024 ? $current_year : "2024-{$current_year}")])
        );
    }
}
