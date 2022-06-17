<?php

namespace App\Http\Requests\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Http\Requests\Traits\WithPasswordRules;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class RegisterRequest extends FormRequest
{
    use WithPasswordRules;

    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return array_merge([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                new Unique(User::class, 'email'),
            ],
            'phone' => 'nullable|string|max:255',
        ], $this->getPasswordRules());
    }

    public function getFirstname(): string
    {
        return (string) $this->input('firstname');
    }

    public function getLastname(): string
    {
        return (string) $this->input('lastname');
    }

    public function getEmail(): string
    {
        return (string) $this->input('email');
    }

    public function getPhone(): ?string
    {
        return $this->filled('phone') ? (string) $this->input('phone') : null;
    }

    public function getPassword(): string
    {
        return (string) $this->input('password');
    }

    public function toDTO(): RegisterDTO
    {
        return new RegisterDTO([
            'firstName' => $this->getFirstname(),
            'lastName' => $this->getLastname(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'password' => $this->getPassword(),
        ]);
    }
}
