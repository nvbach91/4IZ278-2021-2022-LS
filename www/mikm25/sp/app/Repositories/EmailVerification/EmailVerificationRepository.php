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

    public function getByToken(string $token): ?EmailVerification
    {
        /** @var EmailVerification|null $emailVerification */
        $emailVerification = EmailVerification::query()
            ->with(['user'])
            ->ofToken($token)
            ->first();

        return $emailVerification;
    }

    public function markAsUsed(EmailVerification $verification, ?Carbon $time = null): EmailVerification
    {
        $verification->used = true;
        $verification->used_at = $time ?? Carbon::now();
        $verification->save();

        return $verification;
    }

    public function invalidateUserNotUsedVerifications(User $user, ?Carbon $time = null): void
    {
        EmailVerification::query()
            ->ofUserId($user->id)
            ->notUsed()
            ->update([
                'invalidated' => true,
                'invalidated_at' => $time ?? Carbon::now(),
            ]);
    }
}
