<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use Illuminate\Database\Eloquent\Builder;

class PasswordResetBuilder extends Builder
{
    use WithIdQuery;

    public function ofToken(string $token): self
    {
        return $this->where('token', $token);
    }
}
