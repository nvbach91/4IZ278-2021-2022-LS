<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends BaseController
{

    /**
     * Show the profile for a given user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function requestToken(Request $request): JsonResponse
    {

        $code = $request->get('code');
        if (!$code) {
            return abort(400, "Bad request: Missing field 'code'");
        }
        $url = env('GITHUB_OAUTH');
        $response = Http::acceptJson()->post("{$url}/access_token", [
            "client_id" => env("GITHUB_CLIENT_ID"),
            "client_secret" => env("GITHUB_CLIENT_SECRET"),
            "code" => $code,
        ]);
        $githubUser = Socialite::driver('github')->stateless()->userFromToken($response->json()["access_token"]);
        $user = User::updateOrCreate([
            'node_id' => $githubUser['node_id'],
        ], [
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'username' => $githubUser->getNickname(),
            'avatar_url' => $githubUser->getAvatar()
        ]);
        return \response()->json([...$response->json(), "synchronized" => $user["last_synchronized"]], 200);
    }
}
