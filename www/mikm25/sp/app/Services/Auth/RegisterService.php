<?php

namespace App\Services\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Carbon\Carbon;

class RegisterService
{
    public function register(RegisterDTO $registerDTO): ?User
    {
        $user = new User();

        $user->firstname = $registerDTO->firstName;
        $user->lastname = $registerDTO->lastName;
        $user->email = $registerDTO->email;
        $user->password = $registerDTO->password;
        $user->phone_number = $registerDTO->phone;
        $user->github_id = $registerDTO->githubId;
        $user->email_verified_at = !empty($registerDTO->githubId) ? Carbon::now() : null;

        if (! $user->save()) {
            return null;
        }

        return $user;
    }
}
