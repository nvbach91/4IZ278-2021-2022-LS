<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    private $service;

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(
        LoginService $service,
        UserRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request): string
    {
        return view('auth.login', [
            'emailHint' => $request->get('email'),
        ]);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = $this->repository->getUserByEmail($request->getEmail());

        if ($user === null) {
            return redirect()->back()->withInput()->with('status', [
                'danger' => __('status.auth.login.error_credentials'),
            ]);
        }

        if (! $user->is_email_verified) {
            return redirect()->back()->withInput()->with('status', [
                'danger' => __('status.auth.login.error_unverified'),
            ]);
        }

        if (! $this->service->login($user, $request->getPassword(), $request->rememberMe())) {
            return redirect()->back()->withInput()->with('status', [
                'danger' => __('status.auth.login.error_credentials'),
            ]);
        }

        $this->repository->updateLastLoggedAt($user);

        return redirect()->route('app.dashboard')->with('status', [
            'success' => __('status.auth.login.success'),
        ]);
    }
}
