<?php

namespace App\Http\Controllers;

use App\Models\Position;

class PositionController extends Controller
{
    public function index(): string
    {
        $positions = Position::query()
            ->ofUserId(auth('web')->user()->id)
            ->paginate(50);

        return view('app.position.index', [
            'positions' => $positions
        ]);
    }

    public function create(): string
    {
        return view('app.position.create');
    }
}
