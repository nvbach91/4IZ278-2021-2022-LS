<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class PositionBuilder extends Builder
{
    public function ofUserId(int $userId): self
    {
        return $this->where('user_id', $userId);
    }
}