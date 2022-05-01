<?php

namespace App\Models\Builders\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait WithDateQueries
{
    public function fromCurrentMonth(): self
    {
        return $this->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
            ->whereDate('created_at', '<=', Carbon::now()->endOfMonth()->endOfDay());
    }

    public function fromLastMonth(): self
    {
        return $this->whereDate('created_at', '>=', Carbon::now()->subMonth()->startOfMonth()->startOfDay())
            ->whereDate('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->endOfDay());
    }
}
