<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(): string
    {
        return view('app.position.index');
    }
}
