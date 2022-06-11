<?php

namespace App\Repositories\User;

use App\Models\User;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = User::query()->ofEmail($email)->first();

        return $user;
    }

    public function getUserByGithubId(string $githubId): ?User
    {
        /** @var User|null $user */
        $user = User::query()->ofGithubId($githubId)->first();

        return $user;
    }

    public function existsByEmail(string $email): bool
    {
        return User::query()->ofEmail($email)->exists();
    }

    public function verifyEmail(User $user, ?Carbon $at = null): User
    {
        $user->email_verified_at = $at ?? Carbon::now();
        $this->save($user);

        return $user;
    }

    public function changeEmail(User $user, string $email): User
    {
        $user->email = $email;
        $this->save($user);

        return $user;
    }

    public function resetPassword(User $user, string $password): User
    {
        $user->password = $password;
        $this->save($user);

        return $user;
    }

    public function updateLastLoggedAt(User $user, ?Carbon $time = null): User
    {
        $user->last_logged_at = $time ?? Carbon::now();
        $this->save($user);

        return $user;
    }
}
