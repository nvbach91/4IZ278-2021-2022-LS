<?php

namespace App\Http\Controllers;

use App\Constants\PositionTabConstants;
use App\Http\Requests\Positions\PositionStoreRequest;
use App\Models\Branch;
use App\Models\Position;
use App\Services\Company\CompanyService;
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

    /**
     * @var CompanyService
     */
    private $companyService;

    public function __construct(PositionService $positionService, CompanyService $companyService)
    {
        $this->positionService = $positionService;
        $this->companyService = $companyService;
    }

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
        return view('app.position.create', [
            'branches' => Branch::query()->get(),
        ]);
    }

    public function detail(Position $position, string $tab)
    {
        $position->load([
            'branch',
            'company',
        ]);

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

    public function store(PositionStoreRequest $request): RedirectResponse
    {
        $positionStoreDTO = $request->toDTO();

        if ($positionStoreDTO->hasCompany()) {
            $company = $this->companyService->store($positionStoreDTO->company);
        } else {
            $company = null;
        }

        $position = $this->positionService->store($positionStoreDTO, $company);

        return redirect()->route('app.positions.detail', [
            'position' => $position->id,
            'tab' => PositionTabConstants::TAB_DETAIL,
        ])->with('status', [
            'success' => __('status.positions.create.success'),
        ]);
    }
}
