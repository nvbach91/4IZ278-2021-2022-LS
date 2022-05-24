<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WIthTokenQuery;
use App\Models\Builders\Traits\WithUserIdQuery;
use Illuminate\Database\Eloquent\Builder;

class PasswordResetBuilder extends Builder
{
    use WithIdQuery;
    use WIthTokenQuery;
    use WithUserIdQuery;
}
