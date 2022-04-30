<?php

namespace App\View\Models\Dashboards;

use App\Models\Builders\PositionBuilder;
use App\Models\PositionReaction;
use Carbon\Carbon;

class MonthlyPositionReactionsDashboard implements DashboardInterface
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_position_reactions');
    }

    public function getCount(): ?int
    {
        return once(static function (): int {
            return PositionReaction::query()
                ->whereHas('position', static function (PositionBuilder $query): PositionBuilder {
                    return $query->ofUserId(auth()->user()->id);
                })
                ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
                ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->endOfDay())
                ->count();
        });
    }
}