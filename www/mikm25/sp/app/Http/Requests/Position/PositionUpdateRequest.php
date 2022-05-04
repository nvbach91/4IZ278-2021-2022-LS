<?php

namespace App\Http\Requests\Position;

use App\Models\Position;
use App\Models\User;

class PositionUpdateRequest extends PositionStoreRequest
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

        return $user->id === $position->user_id && $position->company->user_id === $user->id;
    }
}
