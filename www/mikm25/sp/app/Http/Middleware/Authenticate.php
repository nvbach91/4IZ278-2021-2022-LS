<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            // Append flash message
            session()->flash('status', [
                'danger' => __('status.auth.unauthenticated'),
            ]);

            return route('auth.login');
        }

        return null;
    }
}
