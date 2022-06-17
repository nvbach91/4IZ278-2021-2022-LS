<?php

namespace App\Models\Casts;

use App\Models\Attributes\PositionWorkloadAttribute;
use App\Models\Company;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PositionWorkloadCast implements CastsAttributes
{
    /**
     * @param Company $model
     * @param string $value
     */
    public function get($model, string $key, $value, array $attributes): ?PositionWorkloadAttribute
    {
        return PositionWorkloadAttribute::of($value);
    }

    /**
     * @param Company $model
     * @param PositionWorkloadAttribute|string $value
     */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value instanceof PositionWorkloadAttribute) {
            return $value->getWorkload();
        }

        return $value;
    }
}
