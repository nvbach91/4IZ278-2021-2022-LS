<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Notifications\User\PasswordResetNotification;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
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

    public function form(Request $request): string
    {
        if (! $request->filled('token')) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.password_reset.invalid_url'),
            ]);
        }

        $token = (string) $request->get('token');

        $passwordReset = $this->passwordResetRepository->getLatest();

        if ($passwordReset === null || $passwordReset->token !== $token || ! $passwordReset->is_usable) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.password_reset.invalid_url'),
            ]);
        }

        return view('auth.password-reset', [
            'token' => $passwordReset->token,
        ]);
    }

    public function reset(PasswordResetRequest $request, string $token): RedirectResponse
    {
        $passwordReset = $this->passwordResetRepository->getByToken($token);

        if ($passwordReset === null || ! $passwordReset->is_usable) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.password_reset.invalid_url'),
            ]);
        }

        $this->userRepository->resetPassword($passwordReset->user, $request->getPassword());

        $this->passwordResetRepository->markAsUsed($passwordReset);

        $passwordReset->user->notify(new PasswordResetNotification());

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.auth.password_reset.success'),
        ]);
    }
}
