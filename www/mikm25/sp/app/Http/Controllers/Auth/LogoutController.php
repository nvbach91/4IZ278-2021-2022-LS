<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogoutRequest;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function logout(LogoutRequest $request): RedirectResponse
    {
        auth('web')->logout();

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.auth.logout.success')
        ]);
    }
}
