<?php

namespace App\Http\Controllers;

use App\Constants\PositionTabConstants;
use App\Http\Requests\Position\PositionStoreRequest;
use App\Http\Requests\Position\PositionUpdateRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Position;
use App\Services\Position\PositionService;
use App\View\Models\Dashboards\MonthlyClicksDashboard;
use App\View\Models\Dashboards\MonthlyReactionsDashboard;
use Illuminate\Http\RedirectResponse;

class PositionController extends Controller
{
    /**
     * @var PositionService
     */
    private $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function index(): string
    {
        $positions = Position::query()
            ->withCount([
                'clicks',
                'reactions',
            ])
            ->with([
                'branch',
                'company',
            ])
            ->ofUserId(auth('web')->user()->id)
            ->paginate(15);

        return view('app.position.index', [
            'positions' => $positions,
        ]);
    }

    public function create(): string
    {
        $companies = Company::query()
            ->ofUserId(auth('web')->user()->id)
            ->get();

        $branches = Branch::query()
            ->get();

        return view('app.position.create', [
            'branches' => $branches,
            'companies' => $companies,
        ]);
    }

    public function show(Position $position, string $tab)
    {
        $position->load([
            'branch',
            'company',
        ]);

        if ($tab === PositionTabConstants::TAB_DETAIL) {
            return view('app.position.tabs.detail', [
                'position' => $position,
                'activeTab' => $tab,
            ]);
        }

        return view('app.position.tabs.statistics', [
            'position' => $position,
            'activeTab' => $tab,
            'dashboards' => [
                new MonthlyClicksDashboard($position),
                new MonthlyReactionsDashboard($position),
            ],
        ]);
    }

    public function store(PositionStoreRequest $request): RedirectResponse
    {
        $position = $this->positionService->storeOrUpdate($request->toDTO());

        return redirect()->route('app.positions.show', [
            'position' => $position->id,
            'tab' => PositionTabConstants::TAB_DETAIL,
        ])->with('status', [
            'success' => __('status.positions.create.success'),
        ]);
    }

    public function edit(Position $position): string
    {
        $position->load([
            'branch',
            'company',
        ]);

        $companies = Company::query()
            ->ofUserId(auth('web')->user()->id)
            ->get();

        $branches = Branch::query()
            ->get();

        return view('app.position.edit', [
            'position' => $position,
            'branches' => $branches,
            'companies' => $companies,
        ]);
    }

    public function update(Position $position, PositionUpdateRequest $request): RedirectResponse
    {
        $position = $this->positionService->storeOrUpdate($request->toDTO(), $position);

        return redirect()->route('app.positions.show', [
            'position' => $position->id,
            'tab' => PositionTabConstants::TAB_DETAIL,
        ])->with('status', [
            'success' => __('status.positions.update.success'),
        ]);
    }
}
