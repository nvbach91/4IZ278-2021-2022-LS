<?php

namespace App\Services\User;

use App\DTOs\User\UserDTO;
use App\Models\User;
use App\Notifications\User\EmailVerificationNotification;
use App\Notifications\User\PasswordResetNotification;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\EmailVerification\EmailVerificationService;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EmailVerificationService
     */
    private $emailVerificationService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmailVerificationService $emailVerificationService
    ) {
        $this->userRepository = $userRepository;
        $this->emailVerificationService = $emailVerificationService;
    }

    public function update(User $user, UserDTO $userDTO): User
    {
        $user->firstname = $userDTO->firstname;
        $user->lastname = $userDTO->lastname;
        $user->phone_number = $userDTO->phone;

        // User changed email -> make him verify his email again!
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
            $emailVerification = $this->emailVerificationService->createForUser($user);
            $user->notify(new EmailVerificationNotification($emailVerification));
        }

        return $user;
    }
}
