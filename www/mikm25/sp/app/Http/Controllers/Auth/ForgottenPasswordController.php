<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgottenPasswordSendRequest;
use App\Notifications\User\ForgottenPasswordNotification;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\PasswordReset\PasswordResetService;
use Illuminate\Http\RedirectResponse;

class ForgottenPasswordController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var PasswordResetService
     */
    private $passwordResetService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordResetService $passwordResetService
    ) {
        $this->userRepository = $userRepository;
        $this->passwordResetService = $passwordResetService;
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

        $passwordReset = $this->passwordResetService->createForUser($user);

        $user->notify(new ForgottenPasswordNotification($passwordReset));

        return redirect()->route('auth.forgotten-password.form')->with('status', [
            'success' => __('status.auth.forgotten_password.success'),
        ]);
    }
}
