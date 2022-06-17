<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Models\PositionClick;
use App\Models\PositionReaction;

interface PositionRepositoryInterface
{
    public function createClick(Position $position): PositionClick;

    public function createReaction(Position $position): PositionReaction;
}
