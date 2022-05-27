<?php

namespace App\Http\Requests\User;

use App\DTOs\User\UserDTO;
use App\Http\Requests\Traits\WithPasswordRules;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;

class UserUpdateRequest extends UserSelfRequest
{
    use WithPasswordRules;

    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user');

        $base = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
        ];

        // gitHub user cannot change his email neither password
        if ($user->github) {
            return $base;
        }

        return array_merge($base, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Exclude user which owns the email
                (new Unique(User::class, 'email'))->whereNot('id', (string) $user->id),
            ],
            'new_password' => [
                'nullable',
                'string',
                'confirmed',
                $this->getPasswordRule(),
            ],
            'new_password_confirmation' => 'required_with:password|nullable|string',
        ]);
    }

    public function toDTO(): UserDTO
    {
        return new UserDTO([
            'firstname' => (string) $this->input('firstname'),
            'lastname' => (string) $this->input('lastname'),
            'phone' => $this->filled('phone') ? (string) $this->input('phone') : null,
            'email' => $this->filled('email') ? (string) $this->input('email') : null,
            'newPassword' => $this->filled('new_password') ? (string) $this->input('new_password') : null,
        ]);
    }
}
