<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Models\PositionClick;
use App\Models\PositionReaction;

class PositionRepository implements PositionRepositoryInterface
{
    public function createClick(Position $position): PositionClick
    {
        $positionClick = new PositionClick();
        $positionClick->position_id = $position->id;

        $positionClick->save();

        return $positionClick;
    }

    public function createReaction(Position $position): PositionReaction
    {
        $positionClick = new PositionReaction();
        $positionClick->position_id = $position->id;

        $positionClick->save();

        return $positionClick;
    }
}
