<?php

namespace App\Repositories\EmailVerification;

use App\Models\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EmailVerificationRepository implements EmailVerificationRepositoryInterface
{
    public function createForUser(User $user): EmailVerification
    {
        $emailVerification = new EmailVerification();
        $emailVerification->token = Str::uuid();
        $emailVerification->user_id = $user->id;
        $emailVerification->valid_until = Carbon::now()->addDays(EmailVerification::VALID_DAYS);

        $emailVerification->save();

        return $emailVerification;
    }

    public function getLatest(): ?EmailVerification
    {
        /** @var EmailVerification|null $emailVerification */
        $emailVerification = EmailVerification::query()->latest()->first();

        return $emailVerification;
    }

    public function markAsUsed(EmailVerification $verification): EmailVerification
    {
        $verification->used = true;
        $verification->save();

        return $verification;
    }
}
