<?php

namespace App\View\Models\Dashboards;

use App\Models\Builders\PositionBuilder;
use App\Models\PositionReaction;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;
use Carbon\Carbon;

class MonthlyPositionReactionsDashboard implements DashboardInterface, HasPreviousValue
{
    public function getTitle(): string
    {
        return __('dashboard.dashboards.monthly_position_reactions.title');
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

    public function getPreviousCount(): ?int
    {
        return once(static function (): int {
            return PositionReaction::query()
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