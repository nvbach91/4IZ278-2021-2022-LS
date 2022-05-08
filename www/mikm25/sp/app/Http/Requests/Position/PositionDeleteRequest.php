<?php

namespace App\Http\Requests\Position;

use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PositionDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! auth('web')->check()) {
            return false;
        }

        /** @var User $user */
        $user = auth('web')->user();

        /** @var Position $position */
        $position = $this->route('position');
        $position->loadMissing('company');

        if ($user->id !== $position->user_id) {
            return false;
        }

        if (! empty($position->company) && $position->company->user_id !== $user->id) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
