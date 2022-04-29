<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function (): void {
    // Guest routes
    Route::group(['middleware' => 'guest:web'], static function (): void {
        Route::get('register', [RegisterController::class, 'index'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    });

    // Guarded logout route
    Route::post('logout', [LogoutController::class, 'logout'])
        ->middleware('auth:web')
        ->name('logout');
});

Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => 'auth:web'], static function (): void {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'positions', 'as' => 'positions.'], static function (): void {
        Route::get('/', [PositionController::class, 'index'])->name('index');
        Route::get('/create', [PositionController::class, 'create'])->name('create');
    });
});
