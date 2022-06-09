<?php

namespace App\View\Composers;

use Illuminate\View\View;

class SidebarViewComposer
{
    public const DIVIDER = null;

    public function compose(View $view): void
    {
        $request = request();

        $view->with('pages', [
            'app.dashboard' => [
                'text' => __('pages.app.dashboard'),
                'icon' => 'bi bi-house',
                'activeIcon' => 'bi bi-house-fill',
                'active' => $request->is('app/dashboard*'),
            ],
            'app.positions.index' => [
                'text' => __('pages.app.positions.index'),
                'icon' => 'bi bi-briefcase',
                'activeIcon' => 'bi bi-briefcase-fill',
                'active' => $request->is('app/positions*'),
            ],
            'app.companies.index' => [
                'text' => __('pages.app.companies.index'),
                'icon' => 'bi bi-building',
                'activeIcon' => 'bi bi-building',
                'active' => $request->is('app/companies*'),
            ],
        ]);
    }
}
