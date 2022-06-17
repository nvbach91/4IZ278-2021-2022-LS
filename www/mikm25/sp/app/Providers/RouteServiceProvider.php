<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Position;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootModelBinding();

        $this->configureRateLimiting();

        $this->routes(static function (): void {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix('mails')
                ->group(base_path('routes/mails.php'));
        });
    }

    private function bootModelBinding(): void
    {
        Route::bind('position', static function ($value): ?Position {
            /** @var User $user */
            $user = auth('web')->user();

            /** @var Position|null $position */
            $position = Position::query()
                ->ofId((int) $value)
                ->ofUserId($user->id)
                ->first();

            return $position;
        });

        Route::bind('slugPosition', static function ($value): ?Position {
            /** @var Position|null $position */
            $position = Position::query()
                ->ofSlug((string) $value)
                ->userHasVerifiedEmail()
                ->first();

            return $position;
        });

        Route::bind('company', static function ($value): ?Company {
            /** @var User $user */
            $user = auth('web')->user();

            /** @var Company|null $company */
            $company = Company::query()
                ->ofId((int) $value)
                ->ofUserId($user->id)
                ->first();

            return $company;
        });

        Route::bind('user', static function ($value): ?User {
            /** @var User|null $user */
            $user = User::query()
                ->ofId((int) $value)
                ->first();

            return $user;
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', static function (Request $request): Limit {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
