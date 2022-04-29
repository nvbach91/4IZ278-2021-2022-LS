<?php

namespace App\View\Models\Dashboards;

use App\Models\Position;
use Carbon\Carbon;

class MonthlyPositionsDashboard implements DashboardInterface
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_positions');
    }

    public function getCount(): ?int
    {
        return once(static function (): ?int {
            return Position::query()
                ->ofUserId(auth('web')->user()->id)
                ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
                ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->endOfDay())
                ->count();
        });
    }
}