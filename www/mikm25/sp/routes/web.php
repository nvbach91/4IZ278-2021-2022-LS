<?php

use App\Enums\PositionTabEnum;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgottenPasswordController;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\LandingPage\PositionController as LandingPagePositionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
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

Route::get('/', [LandingPageController::class, 'index'])
    ->name('landing-page');

Route::get('/show-position/{slugPosition}', [LandingPageController::class, 'showPosition'])
    ->where('slugPosition', '[a-zA-Z0-9\-]+')
    ->name('landing-page.show-position');

Route::get('/{slugPosition}', [LandingPagePositionController::class, 'show'])
    ->where('slugPosition', '[a-zA-Z0-9\-]+')
    ->name('landing-page.position');

Route::get('/{slugPosition}/redirect', [LandingPagePositionController::class, 'redirect'])
    ->where('slugPosition', '[a-zA-Z0-9\-]+')
    ->name('landing-page.position-redirect');

Route::get('/{slugPosition}/react', [LandingPagePositionController::class, 'react'])
    ->where('slugPosition', '[a-zA-Z0-9\-]+')
    ->name('landing-page.position-react');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function (): void {
    Route::group(['prefix' => 'email-verification', 'as' => 'email-verification.'], static function (): void {
        Route::get('verify', [EmailVerificationController::class, 'verify'])
            ->name('verify');
    });

    Route::group(['prefix' => 'password-reset', 'as' => 'password-reset.'], static function (): void {
        Route::get('/', [PasswordResetController::class, 'form'])
            ->name('form');
        Route::post('reset/{token}', [PasswordResetController::class, 'reset'])
            ->whereUuid('token')
            ->name('reset');
    });

    // Guest routes
    Route::group(['middleware' => 'guest:web'], static function (): void {
        Route::get('register', [RegisterController::class, 'index'])
            ->name('register');
        Route::post('register', [RegisterController::class, 'register'])
            ->name('register.submit');

        Route::get('login', [LoginController::class, 'index'])
            ->name('login');
        Route::post('login', [LoginController::class, 'login'])
            ->name('login.submit');

        Route::group(['prefix' => 'forgotten-password', 'as' => 'forgotten-password.'], static function (): void {
            Route::get('/', [ForgottenPasswordController::class, 'form'])
                ->name('form');
            Route::post('send', [ForgottenPasswordController::class, 'send'])
                ->name('send');
        });

        Route::group(['prefix' => 'github', 'as' => 'github.'], static function (): void {
            Route::get('redirect', [GithubController::class, 'redirect'])
                ->name('redirect');
            Route::get('callback', [GithubController::class, 'callback'])
                ->name('callback');
        });
    });

    // Guarded logout route
    Route::post('logout', [LogoutController::class, 'logout'])
        ->middleware(['auth:web'])
        ->name('logout');
});

Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => ['auth:web']], static function (): void {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::group(['prefix' => 'positions', 'as' => 'positions.'], static function (): void {
        Route::get('/', [PositionController::class, 'index'])
            ->name('index');
        Route::get('/create', [PositionController::class, 'create'])
            ->name('create');
        Route::get('/{position}/{tab}', [PositionController::class, 'show'])
            ->where('position', '[0-9]+')
            ->where('tab', implode('|', PositionTabEnum::getValues()))
            ->name('show');
        Route::post('/', [PositionController::class, 'store'])
            ->name('store');
        Route::get('/{position}/edit', [PositionController::class, 'edit'])
            ->where('position', '[0-9]+')
            ->name('edit');
        Route::patch('/{position}', [PositionController::class, 'update'])
            ->where('position', '[0-9]+')
            ->name('update');
        Route::delete('/{position}', [PositionController::class, 'delete'])
            ->where('position', '[0-9]+')
            ->name('delete');
    });

    Route::group(['prefix' => 'companies', 'as' => 'companies.'], static function (): void {
        Route::get('/', [CompanyController::class, 'index'])
            ->name('index');
        Route::get('/create', [CompanyController::class, 'create'])
            ->name('create');
        Route::get('/{company}', [CompanyController::class, 'show'])
            ->where('company', '[0-9]+')
            ->name('show');
        Route::post('/', [CompanyController::class, 'store'])
            ->name('store');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])
            ->where('company', '[0-9]+')
            ->name('edit');
        Route::patch('/{company}', [CompanyController::class, 'update'])
            ->where('company', '[0-9]+')
            ->name('update');
        Route::delete('/{company}', [CompanyController::class, 'delete'])
            ->where('company', '[0-9]+')
            ->name('delete');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], static function (): void {
        Route::get('/profile', [UserController::class, 'profile'])
            ->name('profile');
        Route::get('/{user}', [UserController::class, 'show'])
            ->where('user', '[0-9]+')
            ->name('show');
        Route::delete('/{user}', [UserController::class, 'delete'])
            ->where('user', '[0-9]+')
            ->name('delete');
        Route::get('/{user}/edit', [UserController::class, 'edit'])
            ->where('user', '[0-9]+')
            ->name('edit');
        Route::patch('/{user}', [UserController::class, 'update'])
            ->where('user', '[0-9]+')
            ->name('update');
        Route::post('/{user}/resend-verification-link', [UserController::class, 'resendVerificationLink'])
            ->where('user', '[0-9]+')
            ->name('resend-verification-link');
    });

    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], static function (): void {
        Route::get('/search-tags', [AjaxController::class, 'searchTags'])
            ->name('search-tags');
    });
});
