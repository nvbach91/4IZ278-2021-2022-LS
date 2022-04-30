<?php

namespace App\Models\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait OfIdTrait
{
    public function ofId(int $id): self
    {
        return $this->where('id', $id);
    }
}
