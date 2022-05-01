<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WithDateQueries;
use Illuminate\Database\Eloquent\Builder;

class PositionBuilder extends Builder
{
    use WithIdQuery;
    use WithDateQueries;

    public function ofUserId(int $userId): self
    {
        return $this->where('user_id', $userId);
    }
}
