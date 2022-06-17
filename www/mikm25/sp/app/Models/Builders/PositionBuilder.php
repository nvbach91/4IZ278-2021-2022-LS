<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithDateQueries;
use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WithSlugQuery;
use App\Models\Builders\Traits\WithUserIdQuery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PositionBuilder extends Builder
{
    use WithIdQuery;
    use WithDateQueries;
    use WithUserIdQuery;
    use WithSlugQuery;

    public function valid(): self
    {
        $now = Carbon::now();

        return $this->where(static function (self $builder) use ($now): void {
            $builder->whereNull('valid_from')->orWhereDate('valid_from', '<=', $now);
        })->where(static function (self $builder) use ($now): void {
            $builder->whereNull('valid_until')->orWhereDate('valid_until', '>=', $now);
        });
    }

    public function userHasVerifiedEmail(): self
    {
        return $this->whereHas('user', static function (UserBuilder $builder): void {
            $builder->hasVerifiedEmail();
        });
    }
}
