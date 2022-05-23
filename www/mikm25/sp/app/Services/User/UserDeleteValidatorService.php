<?php

namespace App\Services\User;

use App\Http\Requests\User\UserDeleteRequest;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class UserDeleteValidatorService
{
    /**
     * @var Hasher
     */
    private $hasher;

    public function __construct(Hasher $hasher) {
        $this->hasher = $hasher;
    }

    public function validate(UserDeleteRequest $request, User $user): bool
    {
        if ($user->github) {
            return $this->validateGithub($request, $user);
        }

        return $this->validateBasic($request, $user);
    }

    private function validateBasic(UserDeleteRequest $request, User $user): bool
    {
        /** @var string $password */
        $password = $request->getPassword();

        return $this->hasher->check($password, $user->password);
    }

    private function validateGithub(UserDeleteRequest $request, User $user): bool
    {
        /** @var string $name */
        $name = $request->getName();

        return $name === $user->full_name;
    }
}
