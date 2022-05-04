<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithDateQueries;
use App\Models\Builders\Traits\WithIdQuery;
use Illuminate\Database\Eloquent\Builder;

class PositionReactionBuilder extends Builder
{
    use WithIdQuery;
    use WithDateQueries;
}
