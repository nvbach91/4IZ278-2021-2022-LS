<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandingPage\ReactionRequest;
use App\Models\Position;
use App\Repositories\Position\PositionRepositoryInterface;
use App\Services\Position\PositionService;
use Exception;
use Illuminate\Http\RedirectResponse;

class PositionController extends Controller
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    /**
     * @var PositionService
     */
    private $positionService;

    public function __construct(
        PositionRepositoryInterface $positionRepository,
        PositionService $positionService
    ) {
        $this->positionRepository = $positionRepository;
        $this->positionService = $positionService;
    }

    public function show(Position $position): string
    {
        $position->load([
            'user',
            'branch',
            'company',
            'tags',
        ]);

        return view('landing-page.position', [
            'position' => $position,
        ]);
    }

    public function redirect(Position $position): RedirectResponse
    {
        if (! $position->isExternalUrlSet()) {
            throw new Exception("Cannot redirect to empty external URL.");
        }

        $this->positionRepository->createReaction($position);

        return redirect()->to($position->external_url);
    }

    public function react(Position $position, ReactionRequest $request): RedirectResponse
    {
        if ($position->isExternalUrlSet()) {
            throw new Exception("Cannot react to position with filled external URL.");
        }

        $this->positionRepository->createReaction($position);

        $this->positionService->storeInterest($position, $request->toDTO());

        // todo notification

        return redirect()->route('landing-page.position', ['slugPosition' => $position->slug])->with('status', [
            'success' => __('status.reaction.send.success'),
        ]);
    }
}
