<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WithDateQueries;
use Illuminate\Database\Eloquent\Builder;

class PositionReactionBuilder extends Builder
{
    use WithIdQuery;
    use WithDateQueries;
}
