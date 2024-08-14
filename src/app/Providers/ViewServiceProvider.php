<?php

namespace App\Providers;

use App\View\Components\Admin\AdminAppLayout;
use App\View\Components\Admin\AdminGuestLayout;
use App\View\Components\Admin\MainNavBar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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

        Blade::component('admin-app-layout', AdminAppLayout::class);
        Blade::component('admin-guest-layout', AdminGuestLayout::class);
        Blade::component('admin-main-nav-bar', MainNavBar::class);
    }
}
