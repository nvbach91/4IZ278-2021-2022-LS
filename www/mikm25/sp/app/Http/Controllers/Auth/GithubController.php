<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Notifications\User\RegisteredWithoutVerificationNotification;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    /**
     * @var RegisterService
     */
    private $registerService;

    /**
     * @var LoginService
     */
    private $loginService;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        RegisterService $registerService,
        LoginService $loginService,
        UserRepositoryInterface $userRepository
    ) {
        $this->registerService = $registerService;
        $this->loginService = $loginService;
        $this->userRepository = $userRepository;
    }

    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();

        $user = $this->userRepository->getUserByGithubId((int) $githubUser->getId());

        if ($user === null) {
            // check email existence
            if ($this->userRepository->existsByEmail($githubUser->getEmail())) {
                return redirect()->route('auth.login')->with('status', [
                    'danger' => __('status.auth.register.error_github_email_exists'),
                ]);
            }

            $name = explode(' ', $githubUser->getName());

            $user = $this->registerService->register(new RegisterDTO([
                'firstName' => $name[0],
                'lastName' => $name[1] ?? '',
                'email' => $githubUser->getEmail(),
                'githubId' => (int) $githubUser->getId(),
            ]));
        }

        $user->notify(new RegisteredWithoutVerificationNotification());

        $this->loginService->login($user);

        if ($user->wasRecentlyCreated) {
            return redirect()->route('app.dashboard')->with('status', [
                'success' => __('status.auth.register.success_github'),
            ]);
        }

        return redirect()->route('app.dashboard')->with('status', [
            'success' => __('status.auth.login.success'),
        ]);
    }
}
