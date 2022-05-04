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
                $position->slug = Str::slug($position->name) . "-" . Str::random(4);
            } while (Position::query()->ofSlug($position->slug)->exists());
        }
    }
}
