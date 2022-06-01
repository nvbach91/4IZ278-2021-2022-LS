<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserDeleteSelfRequest;
use App\Http\Requests\User\UserEditSelfRequest;
use App\Http\Requests\User\UserResendVerificationLinkRequest;
use App\Http\Requests\User\UserShowSelfRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Notifications\User\EmailVerificationNotification;
use App\Services\Auth\LogoutService;
use App\Services\EmailVerification\EmailVerificationService;
use App\Services\User\UserDeleteValidatorService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @var UserDeleteValidatorService
     */
    private $deleteValidatorService;

    /**
     * @var EmailVerificationService
     */
    private $emailVerificationService;

    /**
     * @var LogoutService
     */
    private $logoutService;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(
        UserDeleteValidatorService $deleteValidatorService,
        EmailVerificationService $emailVerificationService,
        LogoutService $logoutService,
        UserService $userService
    ) {
        $this->deleteValidatorService = $deleteValidatorService;
        $this->emailVerificationService = $emailVerificationService;
        $this->logoutService = $logoutService;
        $this->userService = $userService;
    }

    public function profile(): RedirectResponse
    {
        /** @var User $user */
        $user = auth('web')->user();

        return redirect()->route('app.users.show', [
            'user' => $user->id,
        ]);
    }

    public function show(User $user, UserShowSelfRequest $request): string
    {
        return view('app.user.show', [
            'user' => $user,
        ]);
    }

    public function delete(User $user, UserDeleteSelfRequest $request): RedirectResponse
    {
        if (! $this->deleteValidatorService->validate($request, $user)) {
            $error = $user->github
                ? ['name' => [__('status.users.delete.nameFailed')]]
                : ['password' => [__('status.users.delete.passwordFailed')]];

            return redirect()->back()
                ->withErrors($error, 'user_delete')
                ->with('show-delete-modal', true);
        }

        $this->logoutService->logout($request);

        // Delete user
        $user->delete();

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.users.delete.success'),
        ]);
    }

    public function edit(User $user, UserEditSelfRequest $request): string
    {
        return view('app.user.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user, UserUpdateRequest $request): RedirectResponse
    {
        $user = $this->userService->update($user, $request->toDTO());

        return redirect()->route('app.users.show', [
            'user' => $user->id,
        ]);
    }

    public function resendVerificationLink(UserResendVerificationLinkRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user('web');

        if ($user->is_email_verified) {
            return redirect()->route('app.users.show', [
                'user' => $user->id,
            ])->with('status', [
                'danger' => __('status.users.resend_verification_link.already_verified'),
            ]);
        }

        $verification = $this->emailVerificationService->createForUser($user);

        $user->notify(new EmailVerificationNotification($verification));

        return redirect()->route('app.users.show', [
            'user' => $user->id,
        ])->with('status', [
            'success' => __('status.users.resend_verification_link.success'),
        ]);
    }
}
