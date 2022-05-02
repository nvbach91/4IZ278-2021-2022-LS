<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['user_id' => "mixed", 'address_id' => "mixed", 'status' => "string", 'variable_symbol' => "string", 'note' => "string"])] public function definition(): array
    {
        $user = User::inRandomOrder()->get();

        return [
            'user_id' => $user[0]->user_id,
            'address_id' => 1,
            'status' => "pending",
            'variable_symbol' => date('Ymd').rand(1,20),
            'note' => $this->faker->realText,
        ];
    }
}
