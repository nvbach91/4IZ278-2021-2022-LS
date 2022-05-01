<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WithDateQueries;
use App\Models\Builders\Traits\WithUserIdQuery;
use Illuminate\Database\Eloquent\Builder;

class PositionBuilder extends Builder
{
    use WithIdQuery;
    use WithDateQueries;
    use WithUserIdQuery;
}
