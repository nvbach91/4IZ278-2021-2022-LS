<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgottenPasswordRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Notifications\User\SendPasswordResetNotification;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ForgottenPasswordController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var PasswordResetRepositoryInterface
     */
    private $passwordResetRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordResetRepositoryInterface $passwordResetRepository
    ) {
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function showForm(): string
    {
        return view('auth.forgotten-password');
    }

    public function sendLink(ForgottenPasswordRequest $request): RedirectResponse
    {
        $user = $this->userRepository->getUserByEmail($request->getEmail());

        if ($user === null) {
            return redirect()->route('auth.forgotten-password.form')->with('status', [
                'success' => __('status.auth.forgotten_password.success'),
            ]);
        }

        $passwordReset = $this->passwordResetRepository->createForUser($user);

        $user->notify(new SendPasswordResetNotification($passwordReset));

        return redirect()->route('auth.forgotten-password.form')->with('status', [
            'success' => __('status.auth.forgotten_password.success'),
        ]);
    }

    public function setupForm(Request $request): string
    {
        if (! $request->filled('token')) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.forgotten_password.invalid_url'),
            ]);
        }

        $token = (string) $request->get('token');

        $passwordReset = $this->passwordResetRepository->getLatest();

        if ($passwordReset === null || $passwordReset->token !== $token || ! $passwordReset->is_usable) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.forgotten_password.invalid_url'),
            ]);
        }

        return view('auth.forgotten-password-reset', [
            'token' => $passwordReset->token,
        ]);
    }

    public function reset(PasswordResetRequest $request, string $token): RedirectResponse
    {
        $passwordReset = $this->passwordResetRepository->getByToken($token);

        if ($passwordReset === null || ! $passwordReset->is_usable) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.forgotten_password.invalid_url'),
            ]);
        }

        $this->userRepository->resetPassword($passwordReset->user, $request->getPassword());

        $this->passwordResetRepository->markAsUsed($passwordReset);

        // TODO send reset password notification

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.auth.forgotten_password.reset_success'),
        ]);
    }
}
