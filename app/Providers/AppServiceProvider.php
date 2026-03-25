<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
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
        //Gates
        Gate::define('user_is_admin', function (User $user) {
            return $user->role === UserRoleEnum::ADMIN;
        });

        Gate::define('can_delete_users', function (User $authUser, User $target) {
            return $authUser->role === UserRoleEnum::ADMIN;
        });
    }
}
