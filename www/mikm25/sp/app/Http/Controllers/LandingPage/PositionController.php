<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Position;

class PositionController extends Controller
{
    public function show(Position $position): string
    {
        return "$position->name";
    }
}
