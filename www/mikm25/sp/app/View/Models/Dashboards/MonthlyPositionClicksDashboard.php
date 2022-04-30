<?php

namespace App\View\Models\Dashboards;

use App\Models\Builders\PositionBuilder;
use App\Models\PositionClick;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;
use Carbon\Carbon;

class MonthlyPositionClicksDashboard implements DashboardInterface, HasPreviousValue
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_position_clicks.title');
    }

    public function getCount(): ?int
    {
        return once(static function (): int {
            return PositionClick::query()
                ->whereHas('position', static function (PositionBuilder $query): PositionBuilder {
                    return $query->ofUserId(auth()->user()->id);
                })
                ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
                ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->endOfDay())
                ->count();
        });
    }

    public function getPreviousCount(): ?int
    {
        return once(static function (): int {
            return PositionClick::query()
                ->whereHas('position', static function (PositionBuilder $query): PositionBuilder {
                    return $query->ofUserId(auth()->user()->id);
                })
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