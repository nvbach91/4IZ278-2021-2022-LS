<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterService
{
    public function registerWithRequest(RegisterRequest $request): ?User
    {
        $user = new User();

        $user->firstname = $request->getFirstname();
        $user->lastname = $request->getLastname();
        $user->email = $request->getEmail();
        $user->password = $request->getPassword();
        $user->phone_number = $request->getPhone();

        if (! $user->save()) {
            return null;
        }

        return $user;
    }
}