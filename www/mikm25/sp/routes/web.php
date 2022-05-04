<?php

use App\Constants\PositionTabConstants;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgottenPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
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

        Route::group(['prefix' => 'email-verification', 'as' => 'email-verification.'], static function (): void {
            Route::get('/', [EmailVerificationController::class, 'form'])->name('form');
            Route::post('resend', [EmailVerificationController::class, 'resend'])->name('resend');
            Route::get('verify', [EmailVerificationController::class, 'verify'])->name('verify');
        });

        Route::group(['prefix' => 'forgotten-password', 'as' => 'forgotten-password.'], static function (): void {
            Route::get('/', [ForgottenPasswordController::class, 'form'])->name('form');
            Route::post('send', [ForgottenPasswordController::class, 'send'])->name('send');
        });

        Route::group(['prefix' => 'password-reset', 'as' => 'password-reset.'], static function (): void {
            Route::get('/', [PasswordResetController::class, 'form'])->name('form');
            Route::post('reset/{token}', [PasswordResetController::class, 'reset'])->name('reset')
                ->whereUuid('token');
        });
    });

    // Guarded logout route
    Route::post('logout', [LogoutController::class, 'logout'])
        ->middleware(['auth:web', 'verified'])
        ->name('logout');
});

Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => ['auth:web', 'verified']], static function (): void {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'positions', 'as' => 'positions.'], static function (): void {
        Route::get('/', [PositionController::class, 'index'])->name('index');
        Route::get('/create', [PositionController::class, 'create'])->name('create');
        Route::get('/{position}/{tab}', [PositionController::class, 'show'])
            ->name('show')
            ->where('position', '[0-9]+')
            ->where('tab', implode('|', PositionTabConstants::getTabs()));
        Route::post('/', [PositionController::class, 'store'])->name('store');
        Route::get('/{position}/edit', [PositionController::class, 'edit'])->name('edit')
            ->where('position', '[0-9]+');
        Route::post('/{position}', [PositionController::class, 'update'])->name('update')
            ->where('position', '[0-9]+');
    });

    Route::group(['prefix' => 'companies', 'as' => 'companies.'], static function (): void {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        Route::get('/{company}', [CompanyController::class, 'show'])->name('show')
            ->where('company', '[0-9]+');
        Route::post('/', [CompanyController::class, 'store'])->name('store');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('edit')
            ->where('company', '[0-9]+');
        Route::post('/{company}', [CompanyController::class, 'update'])->name('update')
            ->where('company', '[0-9]+');
    });

    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], static function (): void {
        Route::get('/search-tags', [AjaxController::class, 'searchTags'])->name('search-tags');
    });
});
