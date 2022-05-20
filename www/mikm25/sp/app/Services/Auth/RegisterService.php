<?php

namespace App\Services\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Models\User;

class RegisterService
{
    public function register(RegisterDTO $registerDTO, bool $facebook = false): ?User
    {
        $user = new User();

        $user->firstname = $registerDTO->firstName;
        $user->lastname = $registerDTO->lastName;
        $user->email = $registerDTO->email;
        $user->password = $registerDTO->password;
        $user->phone_number = $registerDTO->phone;
        $user->created_from_facebook = $facebook;

        if (! $user->save()) {
            return null;
        }

        return $user;
    }
}
