<?php

namespace App\Models\Formatters;

use App\Models\Position;

/**
 * @mixin Position
 */
trait PositionFormatter
{
    public function getFormattedSalary(): ?string
    {
        if (! $this->isSalarySet()) {
            return null;
        }

        return "{$this->salary_from} - {$this->salary_to}";
    }
}
