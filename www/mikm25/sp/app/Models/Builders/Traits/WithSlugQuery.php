<?php

namespace App\Models\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
trait WithSlugQuery
{
    public function ofSlug(string $slug, string $columnName = 'slug'): self
    {
        return $this->where($columnName, $slug);
    }
}
