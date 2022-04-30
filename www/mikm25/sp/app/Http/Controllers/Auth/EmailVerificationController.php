<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * @var EmailVerificationRepositoryInterface
     */
    private $verificationRepository;

    public function __construct(
        UserRepositoryInterface $repository,
        EmailVerificationRepositoryInterface $verificationRepository
    ) {
        $this->repository = $repository;
        $this->verificationRepository = $verificationRepository;
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

        $this->repository->verifyEmail($verification->user);

        return redirect()->route('auth.login', [
            'email' => $verification->user->email,
        ])->with('status', [
            'success' => __('status.auth.email_verification.success'),
        ]);
    }
}
