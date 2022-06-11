<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\PositionApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionApplicationFactory extends Factory
{
    protected $model = PositionApplication::class;

    public function definition(): array
    {
        /** @var Position $position */
        $position = Position::query()->inRandomOrder()->first() ?? Position::factory()->create();

        return [
            'position_id' => $position->id,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->text(1000),
        ];
    }
}
