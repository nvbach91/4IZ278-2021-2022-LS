<?php

namespace App\View\Models\Dashboards;

use App\Models\Builders\PositionBuilder;
use App\Models\Position;
use App\Models\PositionClick;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;

class MonthlyClicksDashboard implements DashboardInterface, HasPreviousValue
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
        return __('common.dashboards.monthly_position_clicks.title');
    }

    public function getCount(): ?int
    {
        return once(function (): int {
            return PositionClick::query()
                ->whereHas('position', function (PositionBuilder $query): PositionBuilder {
                    return $query
                        ->ofUserId(auth('web')->user()->id)
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
            return PositionClick::query()
                ->whereHas('position', function (PositionBuilder $query): PositionBuilder {
                    return $query
                        ->ofUserId(auth('web')->user()->id)
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