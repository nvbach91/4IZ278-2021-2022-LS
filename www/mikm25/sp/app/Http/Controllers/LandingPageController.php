<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request): string
    {
        $positions = Position::query()
            ->with([
                'branch',
                'company'
            ])
            ->paginate(20);

        return view('landing-page.index', [
            'positions' => $positions
        ]);
    }
}
