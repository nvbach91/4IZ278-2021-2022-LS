<?php

namespace App\Services\EmailVerification;

use App\Models\EmailVerification;
use App\Models\User;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;

class EmailVerificationService
{
    /**
     * @var EmailVerificationRepositoryInterface
     */
    private $emailVerificationRepository;

    public function __construct(EmailVerificationRepositoryInterface $emailVerificationRepository)
    {
        $this->emailVerificationRepository = $emailVerificationRepository;
    }

    public function createForUser(User $user): EmailVerification
    {
        // first invalidate all the non-used existing email verifications for user,
        // so he cannot use them
        $this->emailVerificationRepository->invalidateUserNotUsedVerifications($user);

        return $this->emailVerificationRepository->createForUser($user);
    }
}
