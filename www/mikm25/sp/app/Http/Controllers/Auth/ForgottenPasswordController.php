<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgottenPasswordSendRequest;
use App\Notifications\User\ForgottenPasswordNotification;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;

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

    public function form(): string
    {
        return view('auth.forgotten-password');
    }

    public function send(ForgottenPasswordSendRequest $request): RedirectResponse
    {
        $user = $this->userRepository->getUserByEmail($request->getEmail());

        if ($user === null) {
            return redirect()->route('auth.forgotten-password.form')->with('status', [
                'success' => __('status.auth.forgotten_password.success'),
            ]);
        }

        $passwordReset = $this->passwordResetRepository->createForUser($user);

        $user->notify(new ForgottenPasswordNotification($passwordReset));

        return redirect()->route('auth.forgotten-password.form')->with('status', [
            'success' => __('status.auth.forgotten_password.success'),
        ]);
    }
}
