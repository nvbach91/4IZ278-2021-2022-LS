<?php

namespace App\Http\Controllers;

use App\View\Models\Dashboards\MonthlyPositionClicksDashboard;
use App\View\Models\Dashboards\MonthlyPositionReactionsDashboard;
use App\View\Models\Dashboards\MonthlyPositionsDashboard;

class DashboardController extends Controller
{
    public function index(): string
    {
        return view('app.dashboard', [
            'dashboards' => [
                new MonthlyPositionsDashboard(),
                new MonthlyPositionClicksDashboard(),
                new MonthlyPositionReactionsDashboard()
            ]
        ]);
    }
}
