<?php

namespace App\Models\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait WithPositionIdQuery
{
    public function ofPositionId(int $positionId, string $columnName = 'position_id'): self
    {
        return $this->where($columnName, $positionId);
    }
}
