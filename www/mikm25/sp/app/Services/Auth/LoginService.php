<?php

namespace App\Services\Auth;

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

    public function login(User $user, string $password, bool $rememberMe = false): bool
    {
        if (! $this->hasher->check($password, $user->password)) {
            return false;
        }

        auth('web')->login($user, $rememberMe);

        return true;
    }
}
