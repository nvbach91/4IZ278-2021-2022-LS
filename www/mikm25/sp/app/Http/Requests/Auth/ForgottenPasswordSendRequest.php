<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgottenPasswordSendRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
        ];
    }

    public function getEmail(): string
    {
        return (string) $this->input('email');
    }
}
