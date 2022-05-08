<?php

namespace App\View\Models\Dashboards;

use App\Models\Position;
use App\Models\User;
use App\View\Models\Dashboards\Concerns\HasPreviousValue;

class MonthlyPositionsDashboard implements DashboardInterface, HasPreviousValue
{
    public function getTitle(): string
    {
        /** @var string $title */
        $title = __('common.dashboards.monthly_positions.title');

        return $title;
    }

    public function getCount(): ?int
    {
        return once(static function (): int {
            /** @var User $user */
            $user = auth('web')->user();

            return Position::query()
                ->ofUserId($user->id)
                ->fromCurrentMonth()
                ->count();
        });
    }

    public function getPreviousCount(): ?int
    {
        return once(static function (): int {
            /** @var User $user */
            $user = auth('web')->user();

            return Position::query()
                ->ofUserId($user->id)
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
}