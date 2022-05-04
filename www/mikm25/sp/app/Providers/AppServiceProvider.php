<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Ignore sanctum migrations
        Sanctum::ignoreMigrations();
    }

    public function boot(): void
    {
        Paginator::defaultView('common.tables.pagination');

        JsonResource::withoutWrapping();
    }
}
