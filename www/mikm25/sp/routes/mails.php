<?php

use App\Mail\User\ResendEmailVerificationMail;
use App\Mail\User\UserRegisteredMail;
use App\Models\EmailVerification;
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
    Route::get('registered', static function () {
        /** @var User $user */
        $user = User::factory()->make();

        /** @var EmailVerification $emailVerification */
        $emailVerification = EmailVerification::factory()->make([
            'user_id' => $user->id,
        ]);

        return new UserRegisteredMail($user, $emailVerification);
    });

    Route::get('resend-verification-link', static function () {
        /** @var User $user */
        $user = User::factory()->make();

        /** @var EmailVerification $emailVerification */
        $emailVerification = EmailVerification::factory()->make([
            'user_id' => $user->id,
        ]);

        return new ResendEmailVerificationMail($user, $emailVerification);
    });
});
