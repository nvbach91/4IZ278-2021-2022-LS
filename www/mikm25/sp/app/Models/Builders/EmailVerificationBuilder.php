<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WIthTokenQuery;
use App\Models\Builders\Traits\WithUserIdQuery;
use Illuminate\Database\Eloquent\Builder;

class EmailVerificationBuilder extends Builder
{
    use WithIdQuery;
    use WIthTokenQuery;
    use WithUserIdQuery;

    public function used(): self
    {
        return $this->where(['used' => true]);
    }

    public function notUsed(): self
    {
        return $this->where(['used' => false]);
    }
}
