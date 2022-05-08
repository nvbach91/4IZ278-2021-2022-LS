<?php

namespace App\View\Models\Dashboards\Concerns;

interface HasPreviousValue
{
    public function getPreviousCount(): ?int;

    public function getPreviousText(): string;
}
