<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationResendRequest;
use App\Notifications\User\EmailVerificationNotification;
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

    public function form(): string
    {
        return view('auth.email-verification');
    }

    public function resend(EmailVerificationResendRequest $request): RedirectResponse
    {
        $user = $this->userRepository->getUserByEmail($request->getEmail());

        if ($user === null || $user->is_email_verified) {
            return redirect()->route('auth.email-verification.form')->with('status', [
                'success' => __('status.auth.email_verification.resend_success'),
            ]);
        }

        $verification = $this->verificationRepository->createForUser($user);

        $user->notify(new EmailVerificationNotification($verification));

        return redirect()->route('auth.email-verification.form')->with('status', [
            'success' => __('status.auth.email_verification.resend_success'),
        ]);
    }

    public function verify(Request $request): RedirectResponse
    {
        if (! $request->filled('token')) {
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
