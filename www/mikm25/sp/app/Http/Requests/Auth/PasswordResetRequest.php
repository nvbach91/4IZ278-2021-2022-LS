<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Traits\WithPasswordData;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    use WithPasswordData;

    public function authorize(): bool
    {
        return ! auth('web')->check();
    }

    public function rules(): array
    {
        return $this->getPasswordRules();
    }

    public function getPassword(): string
    {
        return (string) $this->input('password');
    }
}
