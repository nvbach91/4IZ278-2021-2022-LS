<?php

namespace App\Services\User;

use App\Http\Requests\User\UserDeleteSelfRequest;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class UserDeleteValidatorService
{
    /**
     * @var Hasher
     */
    private $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function validate(UserDeleteSelfRequest $request, User $user): bool
    {
        if ($user->is_from_github) {
            return $this->validateGithub($request, $user);
        }

        return $this->validateBasic($request, $user);
    }

    private function validateBasic(UserDeleteSelfRequest $request, User $user): bool
    {
        /** @var string $password */
        $password = $request->getPassword();

        /** @var string $userPassword */
        $userPassword = $user->password;

        return $this->hasher->check($password, $userPassword);
    }

    private function validateGithub(UserDeleteSelfRequest $request, User $user): bool
    {
        /** @var string $name */
        $name = $request->getName();

        return $name === $user->full_name;
    }
}
