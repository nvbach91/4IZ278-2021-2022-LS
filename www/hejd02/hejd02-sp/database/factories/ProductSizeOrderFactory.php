<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class ProductSizeOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     #[ArrayShape(['product_size_id' => "mixed", 'order_id' => "mixed", 'product_quantity' => "int"])] public function definition(): array
     {
        $productSize = ProductSize::inRandomOrder()->get();
        $order = Order::inRandomOrder()->get();

        return [
            'product_size_id' => $productSize[0]->product_size_id,
            'order_id' => $order[0]->order_id,
            'product_quantity' => rand(10,100),
            ];
    }
}
