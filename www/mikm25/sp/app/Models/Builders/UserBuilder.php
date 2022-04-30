<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\OfIdTrait;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    use OfIdTrait;

    public function ofEmail(string $email): self
    {
        return $this->where('email', $email);
    }
}