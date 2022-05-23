<?php

namespace App\Http\Requests\User;

use App\Models\User;

class UserDeleteRequest extends SelfUserRequest
{
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user');

        if ($user->github) {
            return [
                'name' => 'required|string',
            ];
        }

        return [
            'password' => 'required|string',
        ];
    }

    public function getName(): ?string
    {
        return $this->filled('name') ? (string) $this->input('name') : null;
    }

    public function getPassword(): ?string
    {
        return $this->filled('password') ? (string) $this->input('password') : null;
    }
}
