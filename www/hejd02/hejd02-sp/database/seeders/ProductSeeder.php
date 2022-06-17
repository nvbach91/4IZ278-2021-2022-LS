<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'slug' => 'bitcoin_pasek',
                'product_name' => 'Bitcoin pásek černý',
                'price' => 1190,
                'color' => 'Černý',
                'category_id' => 1,
                'description' => 'Popis pásku',
            ],
            [
                'slug' => 'ethereum_pasek',
                'product_name' => 'Ethereum pásek černý',
                'price' => 1190,
                'color' => 'Černý',
                'category_id' => 1,
                'description' => 'Popis pásku',
            ],
            [
                'slug' => 'bitcoin_pasek_hnedy',
                'product_name' => 'Bitcoin pásek hnědý',
                'price' => 1190,
                'color' => 'Hnědý',
                'category_id' => 1,
                'description' => 'Popis pásku',
            ],
            [
                'slug' => 'ethereum_pasek_hnedy',
                'product_name' => 'Ethereum pásek hnědý',
                'price' => 1190,
                'color' => 'Hnědý',
                'category_id' => 1,
                'description' => 'Popis pásku',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
