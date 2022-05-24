<?php

namespace App\Services\User;

use App\DTOs\User\UserDTO;
use App\Models\User;
use App\Notifications\User\EmailVerificationNotification;
use App\Notifications\User\PasswordResetNotification;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EmailVerificationRepositoryInterface
     */
    private $emailVerificationRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmailVerificationRepositoryInterface $emailVerificationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->emailVerificationRepository = $emailVerificationRepository;
    }

    public function update(User $user, UserDTO $userDTO): User
    {
        $user->firstname = $userDTO->firstname;
        $user->lastname = $userDTO->lastname;
        $user->phone_number = $userDTO->phone;

        if (! empty($userDTO->email) && $userDTO->email !== $user->email) {
            $user->email = $userDTO->email;
            $user->email_verified_at = null;
        }

        if (! empty($userDTO->newPassword)) {
            $user->password = $userDTO->newPassword;
        }

        $this->userRepository->save($user);

        // Notify user about password change
        if ($user->wasChanged('password')) {
            $user->notify(new PasswordResetNotification());
        }

        // If email changed, send him the link for verification again
        if ($user->wasChanged('email')) {
            $emailVerification = $this->emailVerificationRepository->createForUser($user);
            $user->notify(new EmailVerificationNotification($emailVerification));
        }

        return $user;
    }
}