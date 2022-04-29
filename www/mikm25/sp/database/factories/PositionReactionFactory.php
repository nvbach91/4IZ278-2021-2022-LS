<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\PositionReaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionReactionFactory extends Factory
{
    protected $model = PositionReaction::class;

    public function definition(): array
    {
        /** @var Position $position */
        $position = Position::query()->inRandomOrder()->first() ?? Position::factory()->create();

        return [
            'position_id' => $position->id
        ];
    }
}
