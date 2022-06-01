<?php

namespace App\Services\PasswordReset;

use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;

class PasswordResetService
{
    /**
     * @var PasswordResetRepositoryInterface
     */
    private $passwordResetRepository;

    public function __construct(PasswordResetRepositoryInterface $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function createForUser(User $user): PasswordReset
    {
        // first invalidate all the non-used existing password resets for user,
        // so he cannot use them
        $this->passwordResetRepository->invalidateUserNotUsedPasswordResets($user);

        return $this->passwordResetRepository->createForUser($user);
    }
}
