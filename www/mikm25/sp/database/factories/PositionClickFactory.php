<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\PositionClick;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionClickFactory extends Factory
{
    protected $model = PositionClick::class;

    public function definition(): array
    {
        /** @var Position $position */
        $position = Position::query()->inRandomOrder()->first() ?? Position::factory()->create();

        return [
            'position_id' => $position->id
        ];
    }
}
