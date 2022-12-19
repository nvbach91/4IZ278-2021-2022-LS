<?php

namespace App\Http\Controllers;

use App\Models\SpaceStation;

class StationsController extends Controller
{
    public function fetchByGalaxyId() {
    $galaxyId = 1;

    $spaceStations = SpaceStation::Select('*')
    ->where('galaxy_id', '=', $galaxyId)
    ->get();

    return $spaceStations;
    }

    public function fetchByStationId($stationId) {
    
        $spaceStation = SpaceStation::Select('*')
        ->where('station_id', '=', $stationId)
        ->get();
    
        return $spaceStation;
        }
}
