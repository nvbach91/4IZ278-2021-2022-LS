<?php

namespace App\Repositories\PasswordReset;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;

interface PasswordResetRepositoryInterface
{
    public function createForUser(User $user): PasswordReset;

    public function getByToken(string $token): ?PasswordReset;

    public function markAsUsed(PasswordReset $passwordReset, ?Carbon $time = null): PasswordReset;

    public function invalidateUserNotUsedPasswordResets(User $user, ?Carbon $time = null): void;
}
