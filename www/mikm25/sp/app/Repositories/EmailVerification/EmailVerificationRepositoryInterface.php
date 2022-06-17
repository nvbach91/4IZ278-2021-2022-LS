<?php

namespace App\Repositories\EmailVerification;

use App\Models\EmailVerification;
use App\Models\User;
use Carbon\Carbon;

interface EmailVerificationRepositoryInterface
{
    public function createForUser(User $user): EmailVerification;

    public function getByToken(string $token): ?EmailVerification;

    public function markAsUsed(EmailVerification $verification, ?Carbon $time = null): EmailVerification;

    public function invalidateUserNotUsedVerifications(User $user, ?Carbon $time = null): void;
}
