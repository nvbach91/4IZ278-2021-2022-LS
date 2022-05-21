<?php

namespace App\Services\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Carbon\Carbon;

class RegisterService
{
    public function register(RegisterDTO $registerDTO, bool $github = false): ?User
    {
        $user = new User();

        $user->firstname = $registerDTO->firstName;
        $user->lastname = $registerDTO->lastName;
        $user->email = $registerDTO->email;
        $user->password = $registerDTO->password;
        $user->phone_number = $registerDTO->phone;
        $user->github = $github;
        $user->email_verified_at = $github ? Carbon::now() : null;

        if (! $user->save()) {
            return null;
        }

        return $user;
    }
}
