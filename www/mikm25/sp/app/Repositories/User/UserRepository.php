<?php

namespace App\Repositories\User;

use App\Models\User;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = User::query()->ofEmail($email)->first();

        return $user;
    }

    public function verifyEmail(User $user, ?Carbon $at = null): User
    {
        $user->email_verified_at = $at ?? Carbon::now();
        $user->save();

        return $user;
    }

    public function resetPassword(User $user, string $password): User
    {
        $user->password = $password;
        $user->save();

        return $user;
    }

    public function updateLastLoggedAt(User $user, ?Carbon $time = null): User
    {
        $user->last_logged_at = $time ?? Carbon::now();
        $user->save();

        return $user;
    }
}
