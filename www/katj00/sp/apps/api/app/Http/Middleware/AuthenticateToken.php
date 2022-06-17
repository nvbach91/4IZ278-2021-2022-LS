<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Nuwave\Lighthouse\Support\Http\Middleware\AttemptAuthentication;

class AuthenticateToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $accessToken = $request->bearerToken();
        $response = Socialite::driver('github')->stateless()->userFromToken($accessToken);
        if ($response) {
            $user = DB::table('users')->where('node_id', $response['node_id'])->first();
            $request->merge(['user' => $user ]);
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
            Auth::login($user, true);
        }
//        if ($response->status() !== 200) {
//            return response()->json(["message" => "Unathorized user"], 401);
//        }
//        $user = DB::table('users')->where('gid', $response->json()->user->id);
//        if (!$user) {
//            return response()->json(["message" => "This user doesn't exist"], 403);
//        }
        return $next($request);
    }

    private function validateToken(?string $accessToken)
    {
        return Socialite::driver('github')->stateless()->userFromToken($accessToken);

    }
}
