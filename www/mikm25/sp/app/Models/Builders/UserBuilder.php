<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    use WithIdQuery;

    public function ofEmail(string $email): self
    {
        return $this->where('email', $email);
    }
}
