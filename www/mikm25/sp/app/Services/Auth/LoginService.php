<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Hashing\Hasher;

class LoginService
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        Hasher $hasher,
        UserRepositoryInterface $userRepository
    ) {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
    }

    public function loginWithPassword(User $user, string $password, bool $rememberMe = false): bool
    {
        if (empty($user->password) || ! $this->hasher->check($password, $user->password)) {
            return false;
        }

        return $this->login($user, $rememberMe);
    }

    public function login(User $user, bool $rememberMe = false): bool
    {
        auth('web')->login($user, $rememberMe);

        $this->userRepository->updateLastLoggedAt($user);

        return true;
    }
}
