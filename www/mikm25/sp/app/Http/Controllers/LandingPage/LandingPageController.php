<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Repositories\Position\PositionRepositoryInterface;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function index(Request $request): string
    {
        $positions = Position::query()
            ->with([
                'branch',
                'company',
                'tags',
            ])
            ->paginate(20);

        return view('landing-page.index', [
            'positions' => $positions,
        ]);
    }

    public function showPosition(Position $position): string
    {
        $this->positionRepository->createClick($position);

        return redirect()->route('landing-page.position', ['slugPosition' => $position->slug]);
    }
}
