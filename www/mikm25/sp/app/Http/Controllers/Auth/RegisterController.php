<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Notifications\User\RegisteredNotification;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;
use App\Services\Auth\RegisterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    private $service;

    /**
     * @var EmailVerificationRepositoryInterface
     */
    private $verificationRepository;

    public function __construct(
        RegisterService $service,
        EmailVerificationRepositoryInterface $verificationRepository
    ) {
        $this->service = $service;
        $this->verificationRepository = $verificationRepository;
    }

    public function index(Request $request): string
    {
        return view('auth.register', [
            'emailHint' => $request->get('email'),
        ]);
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->service->registerWithRequest($request);

        if ($user === null) {
            return redirect()->back()->withInput()->with('status', [
                'danger' => __('status.auth.register.error'),
            ]);
        }

        $emailVerification = $this->verificationRepository->createForUser($user);

        $user->notify(new RegisteredNotification($emailVerification));

        return redirect()
            ->route('auth.login', ['email' => $user->email])
            ->with('status', [
                'success' => __('status.auth.register.success'),
            ]);
    }
}
