<?php

namespace App\Providers;

use App\Services\Auth\BearerTokenGuard;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

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

        Auth::extend('bearerToken', function ($app, $name, array $config) {
            return new BearerTokenGuard(Auth::createUserProvider($config['provider']), $app['request']);
        });
        //        Request('social-token', function (Request $request) {
//            $socialUser = Socialite::driver('github')->stateless()->userFromToken($request->bearerToken());
//            if ($socialUser) {
//                $user = DB::table('users')->where('gid', $socialUser->getId())->first();
//                $request->merge(['user' => $user]);
//                $request->setUserResolver(function () use ($user) {
//                    return $user;
//                });
//                return $user;
//            }
//        });
        //
    }
}
