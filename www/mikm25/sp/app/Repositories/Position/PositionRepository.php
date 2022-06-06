<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Models\PositionClick;

class PositionRepository implements PositionRepositoryInterface
{
    public function createClick(Position $position): PositionClick
    {
        $positionClick = new PositionClick();
        $positionClick->position_id = $position->id;

        $positionClick->save();

        return $positionClick;
    }
}
