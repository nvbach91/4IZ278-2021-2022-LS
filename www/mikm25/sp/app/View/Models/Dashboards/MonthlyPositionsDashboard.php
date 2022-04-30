<?php

namespace App\View\Models\Dashboards;

use App\Models\Position;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;
use Carbon\Carbon;

class MonthlyPositionsDashboard implements DashboardInterface, HasPreviousValue
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_positions.title');
    }

    public function getCount(): ?int
    {
        return once(static function (): int {
            return Position::query()
                ->ofUserId(auth('web')->user()->id)
                ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
                ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->endOfDay())
                ->count();
        });
    }

    public function getPreviousCount(): ?int
    {
        return once(static function (): int {
            return Position::query()
                ->ofUserId(auth('web')->user()->id)
                ->whereDate('created_at', '>=', Carbon::now()->subMonth()->startOfMonth()->startOfDay())
                ->whereDate('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->endOfDay())
                ->count();
        });
    }

    public function getPreviousText(): string
    {
        return __('dashboard.dashboards.previous_month');
    }
}