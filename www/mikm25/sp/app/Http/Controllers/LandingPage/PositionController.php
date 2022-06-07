<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Position;

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
            'position' => $position
        ]);
    }
}
