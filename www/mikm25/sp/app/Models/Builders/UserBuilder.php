<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function ofEmail(string $email): self
    {
        return $this->where('email', $email);
    }
}