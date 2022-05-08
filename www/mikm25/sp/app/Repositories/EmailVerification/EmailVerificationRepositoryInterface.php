<?php

namespace App\Repositories\EmailVerification;

use App\Models\EmailVerification;
use App\Models\User;

interface EmailVerificationRepositoryInterface
{
    public function createForUser(User $user): EmailVerification;

    public function getLatest(): ?EmailVerification;

    public function markAsUsed(EmailVerification $verification): EmailVerification;
}
