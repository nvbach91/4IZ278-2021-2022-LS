<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EmailVerificationRepositoryInterface
     */
    private $verificationRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmailVerificationRepositoryInterface $verificationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->verificationRepository = $verificationRepository;
    }

    public function verify(Request $request): RedirectResponse
    {
        if (! $request->filled('token')) {
            return $this->sendFailedResponse();
        }

        $token = (string) $request->get('token');

        $verification = $this->verificationRepository->getByToken($token);

        // non-existing or used link
        if ($verification === null || ! $verification->is_usable) {
            return $this->sendFailedResponse();
        }

        $latest = $this->verificationRepository->getLatestForUser($verification->user);

        // user used one of his older links
        if ($latest->id !== $verification->id) {
            return $this->sendFailedResponse();
        }

        $this->verificationRepository->markAsUsed($verification);

        $this->userRepository->verifyEmail($verification->user);

        return $this->sendSuccessResponse($verification);
    }

    private function sendSuccessResponse(EmailVerification $verification): RedirectResponse
    {
        if (auth('web')->check()) {
            return redirect()->route('app.dashboard')->with('status', [
                'success' => __('status.auth.email_verification.success'),
            ]);
        }

        return redirect()->route('auth.login', [
            'email' => $verification->user->email,
        ])->with('status', [
            'success' => __('status.auth.email_verification.success'),
        ]);
    }

    private function sendFailedResponse(): RedirectResponse
    {
        if (auth('web')->check()) {
            return redirect()->route('app.dashboard')->with('status', [
                'danger' => __('status.auth.email_verification.invalid_url'),
            ]);
        }

        return redirect()->route('auth.login')->with('status', [
            'danger' => __('status.auth.email_verification.invalid_url'),
        ]);
    }
}
