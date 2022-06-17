<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WIthTokenQuery;
use Illuminate\Database\Eloquent\Builder;

class EmailChangeBuilder extends Builder
{
    use WithIdQuery;
    use WIthTokenQuery;
}
