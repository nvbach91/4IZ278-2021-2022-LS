<?php

namespace App\Providers;

use App\Custom\Texts;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-user', function ($user, $userEdit) {
            return ($user->role === Texts::ROLE_ADMIN || ($user->user_id === $userEdit->user_id));
        });
        Gate::define('manage-user-role', function ($user) {
            if ($user->role === Texts::ROLE_USER && isset(request()->role)) {
                return false;
            }
            return true;
        });
        Gate::define('manage-address', function ($user, $address) {
            return ($user->role === Texts::ROLE_ADMIN || ($user->user_id === $address->user_id));
        });
        Gate::define('your-address', function ($user) {
            return $user->role === Texts::ROLE_USER;
        });
        Gate::define('create-address', function ($user) {
            return ($user->role === Texts::ROLE_ADMIN || ($user->role === Texts::ROLE_USER && ($user->user_id === (int)request()->user_id)));
        });

        Gate::define('your-orders', function ($user) {
            return $user->role === Texts::ROLE_USER;
        });

        Gate::define('manage-orders', function ($user, $order) {
            return ($user->role === Texts::ROLE_ADMIN || ($user->user_id === $order->user_id));
        });

        Gate::define('create-orders', function ($user) {
            return ($user->role === Texts::ROLE_ADMIN || ($user->role === Texts::ROLE_USER && ($user->user_id === (int)request()->user_id)));
        });
    }
}
