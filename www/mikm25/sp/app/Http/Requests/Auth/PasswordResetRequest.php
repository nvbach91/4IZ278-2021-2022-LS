<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordResetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'string',
                'confirmed',
                app()->environment('local')
                    ? Password::min(5) // for easy testing
                    : Password::min(9)->numbers()->mixedCase()->letters()->symbols(),
            ],
            'password_confirmation' => 'required|string',
        ];
    }

    public function getPassword(): string
    {
        return (string) $this->input('password');
    }
}
