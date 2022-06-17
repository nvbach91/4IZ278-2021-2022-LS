<?php

namespace App\Repositories\User;

use App\Models\User;
use Carbon\Carbon;

interface UserRepositoryInterface
{
    public function save(User $user): User;

    public function getUserByEmail(string $email): ?User;

    public function getUserByGithubId(string $githubId): ?User;

    public function existsByEmail(string $email): bool;

    public function verifyEmail(User $user, ?Carbon $at = null): User;

    public function changeEmail(User $user, string $email): User;

    public function resetPassword(User $user, string $password): User;

    public function updateLastLoggedAt(User $user, ?Carbon $time = null): User;
}
