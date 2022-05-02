<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use JetBrains\PhpStorm\ArrayShape;

class AuthController extends Controller
{

    public function createUser(UserRequest $request): JsonResponse
    {
        $user = (new UsersController)->store($request);

        return response()->json([
            'token' => $user->createToken('tokens', ['role:' . auth()->user()->role, 'anyone'])->plainTextToken
        ]);
    }

    public function signIn(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Credentials not match'], 401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('API Token', ['role:' . auth()->user()->role, 'anyone'])->plainTextToken
        ]);
    }

    #[ArrayShape(['message' => "string"])] public function signOut(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public static function userAuth(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
