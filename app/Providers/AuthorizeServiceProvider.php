<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthorizeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function($admin,$permission){
            $convertedPermission = ucfirst(str_replace('manage_', '', $permission));
            // dd($convertedPermission);
            return $admin->hasPermission($convertedPermission); //if admin has permission then return tru
        });
    }
}
