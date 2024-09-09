<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Admin;
use App\Models\Admin\AdminRole;
use App\Policies\Admin\AdminPolicy;
use App\Policies\Admin\AdminRolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Admin::class => AdminPolicy::class,
        AdminRole::class => AdminRolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
