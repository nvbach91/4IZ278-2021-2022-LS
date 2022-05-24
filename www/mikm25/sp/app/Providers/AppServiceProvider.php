<?php

namespace App\Providers;

use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use App\Services\Company\CompanyService;
use App\Services\Position\PositionService;
use App\Services\User\UserDeleteValidatorService;
use App\Services\User\UserService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var list<class-string>
     */
    private $services = [
        // Auth
        LoginService::class,
        RegisterService::class,

        // Company
        CompanyService::class,

        // Position
        PositionService::class,

        // User
        UserDeleteValidatorService::class,
        UserService::class,
    ];

    public function register(): void
    {
        // Ignore sanctum migrations
        Sanctum::ignoreMigrations();

        foreach ($this->services as $service) {
            $this->app->singleton($service);
        }
    }

    public function boot(): void
    {
        Paginator::defaultView('common.tables.pagination');

        JsonResource::withoutWrapping();
    }
}
