<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class LoginService
{
    /**
     * @var Hasher
     */
    private $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function loginWithRequest(LoginRequest $request): bool
    {
        /** @var User|null $user */
        $user = User::query()->ofEmail($request->getEmail())->first();

        // User not found
        if ($user === null) {
            return false;
        }

        // Check given password
        if (! $this->hasher->check($request->getPassword(), $user->password)) {
            return false;
        }

        auth()->login($user, $request->rememberMe());

        return true;
    }
}