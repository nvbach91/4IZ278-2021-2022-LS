<?php

namespace Database\Seeders;

use App\Http\Controllers\OrdersController;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductSizeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSizeOrderSeeder::class);
    }
}
