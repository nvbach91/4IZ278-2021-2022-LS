<?php

namespace App\Http\Requests\Traits;

use Illuminate\Validation\Rules\Password;

trait WithPasswordRules
{
    protected function getPasswordRules(): array
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
}