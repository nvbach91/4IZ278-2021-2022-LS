<?php

namespace App\Models\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait WithUserIdQuery
{
    public function ofUserId(int $userId, string $columnName = 'user_id'): self
    {
        return $this->where($columnName, $userId);
    }
}
