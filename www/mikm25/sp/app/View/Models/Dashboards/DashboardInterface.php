<?php

namespace App\View\Models\Dashboards;

interface DashboardInterface
{
    public function getTitle(): string;

    public function getCount(): ?int;
}
