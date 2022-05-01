<?php

namespace App\View\Models\Dashboards;

use App\Models\Position;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;

class MonthlyPositionsDashboard implements DashboardInterface, HasPreviousValue
{
    public function getTitle(): string
    {
        return __('common.dashboards.monthly_positions.title');
    }

    public function getCount(): ?int
    {
        return once(static function (): int {
            return Position::query()
                ->ofUserId(auth('web')->user()->id)
                ->fromCurrentMonth()
                ->count();
        });
    }

    public function getPreviousCount(): ?int
    {
        return once(static function (): int {
            return Position::query()
                ->ofUserId(auth('web')->user()->id)
                ->fromLastMonth()
                ->count();
        });
    }

    public function getPreviousText(): string
    {
        return __('common.dashboards.previous_month');
    }
}