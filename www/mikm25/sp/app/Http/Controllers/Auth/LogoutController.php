<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogoutRequest;
use App\Services\Auth\LogoutService;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    /**
     * @var LogoutService
     */
    private $logoutService;

    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function logout(LogoutRequest $request): RedirectResponse
    {
        $this->logoutService->logout($request);

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.auth.logout.success'),
        ]);
    }
}
