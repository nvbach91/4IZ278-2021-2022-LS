<?php

namespace App\Http\Controllers;

use App\Models\Galaxy;

class GalaxiesController extends Controller
{
    public function fetchAll() {
        $galaxies = Galaxy::all();
        return $galaxies;
    }
}
