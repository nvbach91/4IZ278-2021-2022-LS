<?php

namespace App\Models\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait WIthTokenQuery
{
    public function ofToken(string $token): self
    {
        return $this->where('token', $token);
    }
}
