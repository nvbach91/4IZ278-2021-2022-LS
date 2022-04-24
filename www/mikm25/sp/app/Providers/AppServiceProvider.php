<?php

namespace App\Providers;

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
        //
    }
}
