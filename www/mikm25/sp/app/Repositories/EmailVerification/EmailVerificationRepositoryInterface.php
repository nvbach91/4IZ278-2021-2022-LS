<?php

namespace App\Repositories\EmailVerification;

use App\Models\EmailVerification;
use App\Models\User;

interface EmailVerificationRepositoryInterface
{
    public function createForUser(User $user): EmailVerification;

    public function getLatestForUser(User $user): ?EmailVerification;

    public function getByToken(string $token): ?EmailVerification;

    public function markAsUsed(EmailVerification $verification): EmailVerification;
}
