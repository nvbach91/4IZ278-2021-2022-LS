<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use App\Models\Builders\Traits\WithUserIdQuery;
use Illuminate\Database\Eloquent\Builder;

class CompanyBuilder extends Builder
{
    use WithIdQuery;
    use WithUserIdQuery;

    public function searchByQuery(string $query): self
    {
        return $this->where('name', 'like', "%$query%");
    }
}
