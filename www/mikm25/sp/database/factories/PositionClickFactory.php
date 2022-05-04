<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\PositionClick;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionClickFactory extends Factory
{
    protected $model = PositionClick::class;

    public function definition(): array
    {
        /** @var Position $position */
        $position = Position::query()->inRandomOrder()->first() ?? Position::factory()->create();

        $created = rand(0, 1) === 1 ? Carbon::now()->subMonth() : Carbon::now();

        return [
            'position_id' => $position->id,
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}
