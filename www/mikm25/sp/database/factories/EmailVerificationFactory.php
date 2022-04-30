<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmailVerificationFactory extends Factory
{
    public function definition(): array
    {
        /** @var User $user */
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();

        return [
            'token' => Str::uuid(),
            'user_id' => $user->id
        ];
    }
}
