<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class EmailVerificationBuilder extends Builder
{
    public function ofToken(string $token): self
    {
        return $this->where('token', $token);
    }
}
