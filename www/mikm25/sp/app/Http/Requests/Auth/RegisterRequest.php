<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Unique;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                new Unique(User::class, 'email'),
            ],
            'phone' => 'nullable|string',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->numbers()->mixedCase()->letters()->symbols(),
            ],
            'password_confirmation' => 'required|string',
        ];
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
}
