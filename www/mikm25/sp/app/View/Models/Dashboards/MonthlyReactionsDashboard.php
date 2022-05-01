<?php

namespace App\View\Models\Dashboards;

use App\Models\Builders\PositionBuilder;
use App\Models\Position;
use App\Models\PositionReaction;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;

class MonthlyReactionsDashboard implements DashboardInterface, HasPreviousValue
{
    /**
     * @var Position|null
     */
    private $position;

    public function __construct(?Position $position = null)
    {
        $this->position = $position;
    }

    public function getTitle(): string
    {
        return __('common.dashboards.monthly_position_reactions.title');
    }

    public function getCount(): ?int
    {
        return once(function (): int {
            return PositionReaction::query()
                ->whereHas('position', function (PositionBuilder $query): PositionBuilder {
                    return $query
                        ->ofUserId(auth()->user()->id)
                        ->when(! empty($this->position), function (PositionBuilder $query): PositionBuilder {
                            return $query->ofId($this->position->id);
                        });
                })
                ->fromCurrentMonth()
                ->count();
        });
    }

    public function getPreviousCount(): ?int
    {
        return once(function (): int {
            return PositionReaction::query()
                ->whereHas('position', function (PositionBuilder $query): PositionBuilder {
                    return $query
                        ->ofUserId(auth()->user()->id)
                        ->when(! empty($this->position), function (PositionBuilder $query): PositionBuilder {
                            return $query->ofId($this->position->id);
                        });
                })
                ->fromLastMonth()
                ->count();
        });
    }

    public function getPreviousText(): string
    {
        return __('common.dashboards.previous_month');
    }
}