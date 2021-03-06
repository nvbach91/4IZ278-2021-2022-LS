<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\PasswordReset;
use App\Notifications\User\PasswordResetNotification;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Auth\LogoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var LogoutService
     */
    private $logoutService;

    /**
     * @var PasswordResetRepositoryInterface
     */
    private $passwordResetRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        LogoutService $logoutService,
        PasswordResetRepositoryInterface $passwordResetRepository
    ) {
        $this->userRepository = $userRepository;
        $this->logoutService = $logoutService;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function form(Request $request): string
    {
        if (! $request->filled('token')) {
            return $this->sendFailedViewResponse();
        }

        $token = (string) $request->get('token');

        $passwordReset = $this->passwordResetRepository->getByToken($token);

        // non-existing or non-usable link
        if ($passwordReset === null || ! $passwordReset->is_usable) {
            return $this->sendFailedViewResponse();
        }

        return $this->sendSuccessViewResponse($passwordReset);
    }

    private function sendFailedViewResponse(): string
    {
        return view('auth.password-reset', [
            'errorMessage' => __('status.auth.password_reset.invalid_url'),
        ]);
    }

    private function sendSuccessViewResponse(PasswordReset $passwordReset): string
    {
        return view('auth.password-reset', [
            'token' => $passwordReset->token,
        ]);
    }

    public function reset(PasswordResetRequest $request, string $token): RedirectResponse
    {
        $passwordReset = $this->passwordResetRepository->getByToken($token);

        // non-existing or non-usable link
        if ($passwordReset === null || ! $passwordReset->is_usable) {
            return $this->sendFailedResponse();
        }

        $this->userRepository->resetPassword($passwordReset->user, $request->getPassword());

        $this->passwordResetRepository->markAsUsed($passwordReset);

        $passwordReset->user->notify(new PasswordResetNotification());

        return $this->sendSuccessResponse($request);
    }

    private function sendFailedResponse(): RedirectResponse
    {
        if (auth('web')->check()) {
            return redirect()->route('app.dashboard')->with('status', [
                'danger' => __('status.auth.password_reset.invalid_url'),
            ]);
        }

        return redirect()->route('auth.login')->with('status', [
            'danger' => __('status.auth.password_reset.invalid_url'),
        ]);
    }

    private function sendSuccessResponse(Request $request): RedirectResponse
    {
        // Logout if logged in
        $this->logoutService->logout($request);

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.auth.password_reset.success'),
        ]);
    }
}
