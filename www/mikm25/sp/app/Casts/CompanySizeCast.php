<?php

namespace App\Casts;

use App\Models\Attributes\CompanySizeAttribute;
use App\Models\Company;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CompanySizeCast implements CastsAttributes
{
    /**
     * @param Company $model
     * @param string|null $value
     */
    public function get($model, string $key, $value, array $attributes): ?CompanySizeAttribute
    {
        return $value === null ? null : CompanySizeAttribute::of($value);
    }

    /**
     * @param Company $model
     * @param CompanySizeAttribute|string|null $value
     */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof CompanySizeAttribute) {
            return $value->getSize();
        }

        return $value;
    }
}
