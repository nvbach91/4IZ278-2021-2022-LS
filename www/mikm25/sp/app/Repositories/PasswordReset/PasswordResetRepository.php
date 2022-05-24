<?php

namespace App\Repositories\PasswordReset;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    public function createForUser(User $user): PasswordReset
    {
        $passwordReset = new PasswordReset();
        $passwordReset->token = Str::uuid();
        $passwordReset->user_id = $user->id;
        $passwordReset->valid_until = Carbon::now()->addDays(PasswordReset::VALID_DAYS);

        $passwordReset->save();

        return $passwordReset;
    }

    public function getLatestForUser(User $user): ?PasswordReset
    {
        /** @var PasswordReset|null $passwordReset */
        $passwordReset = PasswordReset::query()
            ->ofUserId($user->id)
            ->latest()
            ->first();

        return $passwordReset;
    }

    public function getByToken(string $token): ?PasswordReset
    {
        /** @var PasswordReset|null $passwordReset */
        $passwordReset = PasswordReset::query()
            ->with(['user'])
            ->ofToken($token)
            ->first();

        return $passwordReset;
    }

    public function markAsUsed(PasswordReset $passwordReset): PasswordReset
    {
        $passwordReset->used = true;
        $passwordReset->save();

        return $passwordReset;
    }
}
