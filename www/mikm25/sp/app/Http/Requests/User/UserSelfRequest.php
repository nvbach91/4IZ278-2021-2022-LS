<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserSelfRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! auth('web')->check()) {
            return false;
        }

        /** @var User $user */
        $user = $this->route('user');

        /** @var User $authUser */
        $authUser = auth('web')->user();

        return $user->id === $authUser->id;
    }

    public function rules(): array
    {
        return [];
    }
}
