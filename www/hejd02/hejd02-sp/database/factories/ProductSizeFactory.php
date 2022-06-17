<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class ProductSizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['product_id' => "mixed", 'size_id' => "mixed", 'remaining_quantity' => "int"])] public function definition(): array
    {
        $product = Product::inRandomOrder()->get();
        $size = Size::inRandomOrder()->get();

        return [
            'product_id' => $product[0]->product_id,
            'size_id' => $size[0]->size_id,
            'remaining_quantity' => rand(10,100),
        ];
    }
}
