<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;
use App\Http\Controllers\GalaxiesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Stations', function (Request $request) {
    $galaxyId = $request->input('galaxy_id');

    $StationsController = new StationsController();
    $stations = $StationsController->fetchByGalaxyId();

    $GalaxiesController = new GalaxiesController();
    $galaxies = $GalaxiesController->fetchAll();

    return view('stations')->with('galaxies', $galaxies)
                          ->with('stations', $stations);

});

Route::get('/Station', function (Request $request) {
    $stationId = $request->input('station_id');

    $StationsController = new StationsController();
    $station = $StationsController->fetchByStationId($stationId);

    return view('station')->with('station', $station)
    ->with('name',[]);
});
