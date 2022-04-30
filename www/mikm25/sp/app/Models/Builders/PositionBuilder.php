<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\OfIdTrait;
use Illuminate\Database\Eloquent\Builder;

class PositionBuilder extends Builder
{
    use OfIdTrait;

    public function ofUserId(int $userId): self
    {
        return $this->where('user_id', $userId);
    }
}
