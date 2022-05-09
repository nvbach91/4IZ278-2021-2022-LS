<?php

namespace App\Observers;

use App\Models\Position;
use Illuminate\Support\Str;

class PositionObserver
{
    public function creating(Position $position): void
    {
        // Generate unique slug for position everytime
        // the position name is updated or the position
        // is created
        if (! $position->exists || $position->isDirty('name')) {
            do {
                $position->slug = $this->getSlug($position);
            } while (Position::query()->ofSlug($position->slug)->exists());
        }
    }

    private function getSlug(Position $position): string
    {
        $slug = Str::slug($position->name);

        $random = Str::random(6);

        return "$slug-$random";
    }
}
