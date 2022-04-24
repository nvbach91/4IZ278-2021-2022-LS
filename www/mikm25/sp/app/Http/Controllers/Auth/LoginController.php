<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    private $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): string
    {
        return view('auth.login', [
            'emailHint' => $request->get('email'),
        ]);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (! $this->service->loginWithRequest($request)) {
            return redirect()->back()->withInput()->with('status', [
                'danger' => __('status.auth.login.error'),
            ]);
        }

        return redirect()->route('app.dashboard');
    }
}
