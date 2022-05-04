<?php

namespace App\Http\Controllers;

use App\View\Models\Dashboards\MonthlyClicksDashboard;
use App\View\Models\Dashboards\MonthlyPositionsDashboard;
use App\View\Models\Dashboards\MonthlyReactionsDashboard;

class DashboardController extends Controller
{
    public function index(): string
    {
        return view('app.dashboard', [
            'dashboards' => [
                new MonthlyPositionsDashboard(),
                new MonthlyClicksDashboard(),
                new MonthlyReactionsDashboard(),
            ],
        ]);
    }
}
