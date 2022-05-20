<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
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
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $facebookUser = Socialite::driver('github')->user();

        $user = $this->userRepository->getUserByEmail($facebookUser->getEmail());

        if (! $user) {
            $name = explode(' ', $facebookUser->getName());

            $user = $this->registerService->register(new RegisterDTO([
                'firstName' => $name[0],
                'lastName' => $name[1] ?? '',
                'email' => $facebookUser->getEmail(),
                'password' => Str::random(20),
            ]), true);
        }

        $this->loginService->login($user);

        return redirect()->route('app.dashboard')->with('status', [
            'success' => __('status.auth.login.success'),
        ]);
    }
}
