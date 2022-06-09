<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Exception;
use Illuminate\Http\RedirectResponse;

class PositionController extends Controller
{
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
        if (empty($position->external_url)) {
            throw new Exception("Cannot redirect to empty external URL.");
        }

        return redirect()->to($position->external_url);
    }
}
