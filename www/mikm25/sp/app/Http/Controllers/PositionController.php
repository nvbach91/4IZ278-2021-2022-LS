<?php

namespace App\Http\Controllers;

use App\Enums\PositionTabEnum;
use App\Http\Requests\Position\PositionDeleteRequest;
use App\Http\Requests\Position\PositionStoreRequest;
use App\Http\Requests\Position\PositionUpdateRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Position;
use App\Models\PositionApplication;
use App\Models\User;
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
        /** @var User $user */
        $user = auth('web')->user();

        $positions = Position::query()
            ->withCount([
                'clicks',
                'reactions',
            ])
            ->with([
                'branch',
                'company',
            ])
            ->ofUserId($user->id)
            ->paginate(15);

        return view('app.position.index', [
            'positions' => $positions,
        ]);
    }

    public function create(): string
    {
        /** @var User $user */
        $user = auth('web')->user();

        $companies = Company::query()
            ->ofUserId($user->id)
            ->get();

        $branches = Branch::query()
            ->get();

        return view('app.position.create', [
            'branches' => $branches,
            'companies' => $companies,
        ]);
    }

    public function show(Position $position, string $tab): string
    {
        $position->load([
            'branch',
            'company',
        ]);

        $tab = PositionTabEnum::make($tab);

        if ($tab->isEqual(PositionTabEnum::detail())) {
            return view('app.position.tabs.detail', [
                'position' => $position,
                'activeTab' => $tab,
            ]);
        } else if ($tab->isEqual(PositionTabEnum::applications())) {
            $applications = PositionApplication::query()
                ->ofPositionId($position->id)
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return view('app.position.tabs.applications', [
                'position' => $position,
                'activeTab' => $tab,
                'applications' => $applications
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
            'tab' => PositionTabEnum::detail()->getValue(),
        ])->with('status', [
            'success' => __('status.positions.create.success'),
        ]);
    }

    public function edit(Position $position): string
    {
        /** @var User $user */
        $user = auth('web')->user();

        $position->load([
            'branch',
            'company',
        ]);

        $companies = Company::query()
            ->ofUserId($user->id)
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
            'tab' => PositionTabEnum::detail()->getValue(),
        ])->with('status', [
            'success' => __('status.positions.update.success'),
        ]);
    }

    public function delete(Position $position, PositionDeleteRequest $request): RedirectResponse
    {
        $position->delete();

        return redirect()->route('app.positions.index')->with('status', [
            'success' => __('status.positions.delete.success', [
                'positionName' => $position->name,
            ]),
        ]);
    }
}
