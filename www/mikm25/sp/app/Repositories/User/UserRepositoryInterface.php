<?php

namespace App\Repositories\User;

use App\Models\User;
use Carbon\Carbon;

interface UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?User;

    public function verifyEmail(User $user, ?Carbon $at = null): User;
}