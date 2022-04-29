<?php

namespace App\View\Models\Dashboards;

use App\Models\Position;
use Carbon\Carbon;

class MonthlyPositionClicksDashboard implements DashboardInterface
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_position_clicks');
    }

    public function getCount(): ?int
    {
        return 0;
    }
}