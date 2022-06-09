<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Repositories\Position\PositionRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;

class PositionController extends Controller
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
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

    public function react(Position $position): RedirectResponse
    {
        if ($position->isExternalUrlSet()) {
            throw new Exception("Cannot react to position with filled external URL.");
        }

        dd(request()->all());
    }
}
