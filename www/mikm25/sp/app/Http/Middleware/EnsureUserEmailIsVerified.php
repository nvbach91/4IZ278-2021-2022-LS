<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureUserEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User|null $user */
        $user = $request->user('web');

        if ($user === null || ! $user->is_email_verified) {
            if ($request->expectsJson()) {
                abort(403, 'You need to verify your email.');
            }

            // Logout user!
            auth('web')->logout();

            return redirect()->route('auth.login')->with('status', [
                'danger' => __('status.auth.login.error_unverified'),
            ]);
        }

        return $next($request);
    }
}
