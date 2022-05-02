<?php

namespace Database\Seeders;

use App\Models\ProductSizeOrder;
use Illuminate\Database\Seeder;

class ProductSizeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSizeOrder::factory(5)->create();
    }
}
