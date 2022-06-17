<?php

namespace App\Providers;

use App\View\Composers\SidebarViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('app.template.sidebar', SidebarViewComposer::class);
    }
}
