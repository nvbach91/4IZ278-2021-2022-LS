<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productSizes = [
//            btc black
            [
                'product_id' => 1,
                'size_id' => 6,
                'remaining_quantity' => 1,
            ],
            [
                'product_id' => 1,
                'size_id' => 7,
                'remaining_quantity' => 1,
            ],
            [
                'product_id' => 1,
                'size_id' => 10,
                'remaining_quantity' => 2,
            ],
//eth black
            [
                'product_id' => 2,
                'size_id' => 7,
                'remaining_quantity' => 1,
            ],
            [
                'product_id' => 2,
                'size_id' => 8,
                'remaining_quantity' => 2,
            ],
            [
                'product_id' => 2,
                'size_id' => 9,
                'remaining_quantity' => 2,
            ],
//btc brown
            [
                'product_id' => 3,
                'size_id' => 6,
                'remaining_quantity' => 2,
            ],
            [
                'product_id' => 3,
                'size_id' => 7,
                'remaining_quantity' => 1,
            ],
            [
                'product_id' => 3,
                'size_id' => 10,
                'remaining_quantity' => 2,
            ],
//eth brown
            [
                'product_id' => 4,
                'size_id' => 7,
                'remaining_quantity' => 2,
            ],
            [
                'product_id' => 4,
                'size_id' => 8,
                'remaining_quantity' => 2,
            ],
            [
                'product_id' => 4,
                'size_id' => 9,
                'remaining_quantity' => 1,
            ],
        ];

        foreach ($productSizes as $productSize) {
            ProductSize::create($productSize);
        }
    }
}
