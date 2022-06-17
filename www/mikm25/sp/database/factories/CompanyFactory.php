<?php

namespace Database\Factories;

use App\Models\Attributes\CompanySizeAttribute;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        /** @var User $user */
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();

        return [
            'user_id' => $user->id,
            'name' => $this->faker->company,
            'size' => CompanySizeAttribute::of(CompanySizeAttribute::SIZE_TO_50),
            'url' => $this->faker->url,
            'address' => $this->faker->address,
            'contact_email' => $this->faker->unique()->email,
        ];
    }
}
