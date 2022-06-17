<?php

namespace App\Http\Requests\Traits;

use Illuminate\Validation\Rules\Password;

trait WithPasswordRules
{
    protected function getPasswordRules(string $field = 'password'): array
    {
        return [
            $field => [
                'required',
                'string',
                'confirmed',
                $this->getPasswordRule(),
            ],
            $field . '_confirmation' => 'required|string',
        ];
    }

    protected function getPasswordRule(): Password
    {
        return app()->environment('local')
            ? Password::min(5) // for easy local testing
            : Password::min(9)->numbers()->mixedCase()->letters()->symbols();
    }
}
