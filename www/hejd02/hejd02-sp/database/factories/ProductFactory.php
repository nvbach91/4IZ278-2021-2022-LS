<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['product_name' => "string", 'price' => "int", 'color' => "string", 'category_id' => "mixed", 'description' => "string"])] public function definition(): array
    {
        $cat = Category::inRandomOrder()->get();

        return [
            'product_name' => $this->faker->domainName,
            'price' => $this->faker->randomNumber(2),
            'color' => $this->faker->colorName,
            'category_id' => $cat[0]->category_id,
            'description' => $this->faker->realText,
        ];
    }
}
