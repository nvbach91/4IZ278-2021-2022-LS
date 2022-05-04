<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Position;
use App\Models\PositionClick;
use App\Models\PositionReaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition(): array
    {
        /** @var Branch $branch */
        $branch = Branch::query()->inRandomOrder()->first() ?? Branch::factory()->create();

        /** @var User $user */
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();

        /** @var Company $company */
        $company = Company::query()->inRandomOrder()->first() ?? Company::factory()->create();

        return [
            'user_id' => $user->id,
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'name' => $this->faker->words(4, true),
            'salary_from' => rand(500, 60000),
            'salary_to' => static function (array $attributes): int {
                return rand($attributes['salary_from'], $attributes['salary_from'] + 50000);
            },
            'external_url' => null,
            'content' => $this->faker->text(900),
            'workplace_address' => $this->faker->address,
            'valid_from' => Carbon::now()->subDays(5),
            'valid_until' => Carbon::now()->addDays(5),
            'min_practice_length' => rand(0, 10),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(static function (Position $position): void {
            PositionClick::factory()->count(rand(10, 50))->create([
                'position_id' => $position->id,
            ]);

            PositionReaction::factory()->count(rand(10, 50))->create([
                'position_id' => $position->id,
            ]);
        });
    }

    public function invalidPast(): self
    {
        return $this->state(static function (): array {
            return [
                'valid_from' => Carbon::now()->subDays(20),
                'valid_until' => Carbon::now()->subDays(5),
            ];
        });
    }

    public function invalidFuture(): self
    {
        return $this->state(static function (): array {
            return [
                'valid_from' => Carbon::now()->addDays(5),
                'valid_until' => Carbon::now()->addDays(20),
            ];
        });
    }
}
