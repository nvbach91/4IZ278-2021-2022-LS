<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\OfIdTrait;
use Illuminate\Database\Eloquent\Builder;

class EmailVerificationBuilder extends Builder
{
    use OfIdTrait;

    public function ofToken(string $token): self
    {
        return $this->where('token', $token);
    }
}
