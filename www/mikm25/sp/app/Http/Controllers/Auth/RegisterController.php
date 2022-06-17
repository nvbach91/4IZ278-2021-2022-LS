<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Notifications\User\RegisteredNotification;
use App\Services\Auth\RegisterService;
use App\Services\EmailVerification\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    private $registerService;

    /**
     * @var EmailVerificationService
     */
    private $emailVerificationService;

    public function __construct(
        RegisterService $registerService,
        EmailVerificationService $emailVerificationService
    ) {
        $this->registerService = $registerService;
        $this->emailVerificationService = $emailVerificationService;
    }

    public function index(Request $request): string
    {
        return view('auth.register', [
            'emailHint' => $request->get('email'),
        ]);
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->registerService->register($request->toDTO());

        if ($user === null) {
            return redirect()->back()->withInput()->with('status', [
                'danger' => __('status.auth.register.error'),
            ]);
        }

        $emailVerification = $this->emailVerificationService->createForUser($user);

        $user->notify(new RegisteredNotification($emailVerification));

        return redirect()
            ->route('auth.login', ['email' => $user->email])
            ->with('status', [
                'success' => __('status.auth.register.success'),
            ]);
    }
}
