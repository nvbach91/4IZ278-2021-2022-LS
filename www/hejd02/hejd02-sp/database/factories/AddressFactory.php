<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['user_id' => "mixed", 'region' => "string", 'town' => "string", 'street' => "string", 'street_number' => "int", 'zip' => "int"])] public function definition(): array
    {
        $user = User::inRandomOrder()->get();

        return [
            'user_id' => $user[0]->user_id,
            'region' => $this->faker->city,
            'town' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'street_number' => $this->faker->randomDigit(),
            'zip' => $this->faker->numberBetween(00000,50000),
        ];
    }
}
