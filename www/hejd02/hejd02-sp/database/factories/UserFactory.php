<?php

namespace Database\Factories;

use App\Custom\Texts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['role' => "string", 'first_name' => "string", 'last_name' => "string", 'phone' => "string", 'password' => "string", 'email' => "string"])] public function definition(): array
    {
        $pwd = Hash::make($this->faker->firstName.date('Y'));

        return [
            'role' => Texts::ROLE_USER,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'password' => $pwd, // password
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }

}
