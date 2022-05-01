<?php

namespace App\Http\Controllers;

use App\Constants\PositionTabConstants;
use App\Models\Position;
use App\View\Models\Dashboards\MonthlyClicksDashboard;
use App\View\Models\Dashboards\MonthlyReactionsDashboard;

class PositionController extends Controller
{
    public function index(): string
    {
        $positions = Position::query()
            ->withCount([
                'clicks',
                'reactions',
            ])
            ->ofUserId(auth('web')->user()->id)
            ->paginate(15);

        return view('app.position.index', [
            'positions' => $positions,
        ]);
    }

    public function create(): string
    {
        return view('app.position.create');
    }

    public function detail(Position $position, string $tab)
    {
        $position->load('branch');

        if ($tab === PositionTabConstants::TAB_DETAIL) {
            return view('app.position.detail.tab-detail', [
                'position' => $position,
                'activeTab' => $tab,
            ]);
        }

        if ($tab === PositionTabConstants::TAB_STATISTICS) {
            return view('app.position.detail.tab-statistics', [
                'position' => $position,
                'activeTab' => $tab,
                'dashboards' => [
                    new MonthlyClicksDashboard($position),
                    new MonthlyReactionsDashboard($position),
                ],
            ]);
        }

        return view('app.position.detail.tab-log', [
            'position' => $position,
            'activeTab' => $tab,
        ]);
    }
}
