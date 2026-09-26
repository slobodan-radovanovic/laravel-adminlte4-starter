<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        // Super Admins pass every permission check, including permissions added later.
        Gate::before(fn (User $user) => $user->isSuperAdmin() ? true : null);

        // Only Super Admins may assign the Super Admin role or manage Super Admin users and the role itself.
        Gate::define('manage super admins', fn (User $user) => false);
    }
}
