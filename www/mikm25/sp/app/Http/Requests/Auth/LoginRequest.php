<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'nullable|boolean',
        ];
    }

    public function getEmail(): string
    {
        return (string) $this->input('email');
    }

    public function getPassword(): string
    {
        return (string) $this->input('password');
    }

    public function rememberMe(): bool
    {
        return $this->filled('remember_me') && $this->input('remember_me');
    }
}
