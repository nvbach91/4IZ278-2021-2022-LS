<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;

class LogoutService
{
    public function logout(Request $request): void
    {
        if (! auth('web')->check()) {
            return;
        }

        auth('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}