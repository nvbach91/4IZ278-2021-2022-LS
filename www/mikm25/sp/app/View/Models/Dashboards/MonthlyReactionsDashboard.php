<?php

namespace App\View\Models\Dashboards;

use App\Models\Builders\PositionBuilder;
use App\Models\Position;
use App\Models\PositionReaction;
use App\Models\User;
use App\View\Models\Dashboards\Concerns\HasHelpText;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;

class MonthlyReactionsDashboard implements DashboardInterface, HasPreviousValue, HasHelpText
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
        /** @var string $title */
        $title = __('common.dashboards.monthly_position_reactions.title');

        return $title;
    }

    public function getCount(): ?int
    {
        return once(function (): int {
            return PositionReaction::query()
                ->whereHas('position', function (PositionBuilder $query): PositionBuilder {
                    /** @var User $user */
                    $user = auth('web')->user();

                    return $query
                        ->ofUserId($user->id)
                        ->when(! empty($this->position), function (PositionBuilder $query): PositionBuilder {
                            /** @var Position $position */
                            $position = $this->position;

                            return $query->ofId($position->id);
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
                    /** @var User $user */
                    $user = auth('web')->user();

                    return $query
                        ->ofUserId($user->id)
                        ->when(! empty($this->position), function (PositionBuilder $query): PositionBuilder {
                            /** @var Position $position */
                            $position = $this->position;

                            return $query->ofId($position->id);
                        });
                })
                ->fromLastMonth()
                ->count();
        });
    }

    public function getPreviousText(): string
    {
        /** @var string $previousText */
        $previousText = __('common.dashboards.previous_month');

        return $previousText;
    }

    public function getHelpText(): string
    {
        /** @var string $helpText */
        $helpText = __('common.dashboards.monthly_position_reactions.help');

        return $helpText;
    }
}
