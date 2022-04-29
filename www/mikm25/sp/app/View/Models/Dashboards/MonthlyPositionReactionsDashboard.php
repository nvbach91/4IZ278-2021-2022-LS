<?php

namespace App\View\Models\Dashboards;

class MonthlyPositionReactionsDashboard implements DashboardInterface
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_position_reactions');
    }

    public function getCount(): ?int
    {
        return 0;
    }
}