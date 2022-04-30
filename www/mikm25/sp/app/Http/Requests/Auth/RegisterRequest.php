<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Traits\WithPasswordData;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class RegisterRequest extends FormRequest
{
    use WithPasswordData;

    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return array_merge([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                new Unique(User::class, 'email'),
            ],
            'phone' => 'nullable|string',
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
}
