<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    var_dump(["Xf", ["sdf21"]]);
    return view('welcome');
});
Route::get('/404', function () {
    return view('errors.404');
});
