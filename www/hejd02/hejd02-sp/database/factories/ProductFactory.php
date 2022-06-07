<?php

namespace Database\Factories;

use App\Components\FormatText;
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
    #[ArrayShape(['product_name' => "string", 'slug' => "string", 'price' => "int", 'color' => "string", 'category_id' => "mixed", 'description' => "string"])] public function definition(): array
    {
        $cat = Category::inRandomOrder()->get();
        $format = new FormatText();
        $name = $this->faker->firstName. ' '. $this->faker->lastName;
        return [
            'product_name' => $name,
            'slug' => $format->slug($name),
            'price' => $this->faker->randomNumber(2),
            'color' => $this->faker->colorName,
            'category_id' => $cat[0]->category_id,
            'description' => $this->faker->realText,
        ];
    }
}
