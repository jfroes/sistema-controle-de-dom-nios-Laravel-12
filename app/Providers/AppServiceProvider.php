<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use App\Models\Domain;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        //UI Components
        View::share('ui', config('ui'));
            //Gates
        Gate::define('user_is_admin', function (User $user) {
            return $user->role === UserRoleEnum::ADMIN;
        });

        Gate::define('can_delete_users', function (User $authUser, User $target) {
            return $authUser->role === UserRoleEnum::ADMIN;
        });

        Gate::define('can_delete_domains', function (User $authUser, Domain $domain) {
            return $authUser->role === UserRoleEnum::ADMIN;
        });
    }
}
