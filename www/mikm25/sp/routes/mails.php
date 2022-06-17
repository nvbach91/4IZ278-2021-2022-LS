<?php

use App\Mail\Position\NewApplicationMail;
use App\Mail\User\EmailVerificationMail;
use App\Mail\User\RegisteredMail;
use App\Models\EmailVerification;
use App\Models\Position;
use App\Models\PositionApplication;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mail Routes
|--------------------------------------------------------------------------
|
| Here is where you can register mail routes to preview emails without even
| sending them. Emails can be previewed only on local environments.
|
*/

if (! app()->environment('local')) {
    return;
}

Route::group(['prefix' => 'user'], static function (): void {
    Route::get('registered', static function (): RegisteredMail {
        /** @var User $user */
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->make();

        /** @var EmailVerification $emailVerification */
        $emailVerification = EmailVerification::factory()->make([
            'user_id' => $user->id,
        ]);

        return new RegisteredMail($user, $emailVerification);
    });

    Route::get('resend-verification-link', static function (): EmailVerificationMail {
        /** @var User $user */
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->make();

        /** @var EmailVerification $emailVerification */
        $emailVerification = EmailVerification::factory()->make([
            'user_id' => $user->id,
        ]);

        return new EmailVerificationMail($user, $emailVerification);
    });
});

Route::group(['prefix' => 'position'], static function (): void {
    Route::get('new-application', static function (): NewApplicationMail {
        /** @var Position $position */
        $position = Position::query()->inRandomOrder()->first() ?? Position::factory()->make();

        /** @var PositionApplication $application */
        $application = PositionApplication::factory()->make();

        return new NewApplicationMail($position, $application);
    });
});
