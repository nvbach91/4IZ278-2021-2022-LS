<?php

namespace App\Repositories\PasswordReset;

use App\Models\PasswordReset;
use App\Models\User;

interface PasswordResetRepositoryInterface
{
    public function createForUser(User $user): PasswordReset;

    public function getLatest(): ?PasswordReset;

    public function markAsUsed(PasswordReset $passwordReset): PasswordReset;

    public function getByToken(string $token): ?PasswordReset;
}
