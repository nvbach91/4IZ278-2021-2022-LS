<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Models\PositionClick;

interface PositionRepositoryInterface
{
    public function createClick(Position $position): PositionClick;
}
