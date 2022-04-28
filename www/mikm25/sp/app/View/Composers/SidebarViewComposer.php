<?php

namespace App\View\Composers;

use Illuminate\View\View;

class SidebarViewComposer
{
    public const DIVIDER = null;

    public function compose(View $view): void
    {
        $view->with('pages', [
            'app.dashboard' => [
                'text' => __('pages.app.dashboard'),
                'icon' => 'bi bi-house',
            ],
        ]);

        $view->with('currentRoute', request()->route()->getName());
    }
}