<?php

namespace App\Repositories\User;

use App\Models\User;
use Carbon\Carbon;

interface UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?User;

    public function verifyEmail(User $user, ?Carbon $at = null): User;

    public function resetPassword(User $user, string $password): User;

    public function updateLastLoggedAt(User $user, ?Carbon $time = null): User;
}
