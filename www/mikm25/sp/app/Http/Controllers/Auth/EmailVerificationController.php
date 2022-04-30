<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendEmailVerificationRequest;
use App\Notifications\User\ResendEmailVerificationNotification;
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

    public function resendForm(): string
    {
        return view('auth.resend-verification');
    }

    public function resend(ResendEmailVerificationRequest $request): RedirectResponse
    {
        $user = $this->userRepository->getUserByEmail($request->getEmail());

        if ($user === null || $user->is_email_verified) {
            return redirect()->route('auth.email-verification.resend.form')->with('status', [
                'success' => __('status.auth.resend_email_verification.success'),
            ]);
        }

        $verification = $this->verificationRepository->createForUser($user);

        $user->notify(new ResendEmailVerificationNotification($verification));

        return redirect()->route('auth.email-verification.resend.form')->with('status', [
            'success' => __('status.auth.resend_email_verification.success'),
        ]);
    }

    public function verify(Request $request): RedirectResponse
    {
        if (! $request->hasValidSignature() || ! $request->filled('token')) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.email_verification.invalid_url'),
            ]);
        }

        $token = (string) $request->get('token');

        $verification = $this->verificationRepository->getLatest();

        if ($verification === null || $verification->token !== $token || ! $verification->is_usable) {
            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.email_verification.invalid_url'),
            ]);
        }

        $this->verificationRepository->markAsUsed($verification);

        $this->userRepository->verifyEmail($verification->user);

        return redirect()->route('auth.login', [
            'email' => $verification->user->email,
        ])->with('status', [
            'success' => __('status.auth.email_verification.success'),
        ]);
    }
}
