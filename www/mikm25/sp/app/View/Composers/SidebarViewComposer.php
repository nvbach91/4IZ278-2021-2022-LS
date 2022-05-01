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
                'active' => $request->is('app/dashboard*'),
            ],
            'app.positions.index' => [
                'text' => __('pages.app.positions.index'),
                'icon' => 'bi bi-briefcase',
                'active' => $request->is('app/positions*'),
            ],
        ]);
    }
}