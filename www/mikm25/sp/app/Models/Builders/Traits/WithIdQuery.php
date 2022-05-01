<?php

namespace App\Models\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait WithIdQuery
{
    public function ofId(int $id): self
    {
        return $this->where('id', $id);
    }
}
