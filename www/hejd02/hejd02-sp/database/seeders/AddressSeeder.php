<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'user_id' => 1,
                'region' => "Karlovarský kraj",
                'town' => "Cheb",
                'street' => "Šeříková",
                'street_number' => "5.",
                'zip' => "350 02",
            ]
        ];

        foreach ($addresses as $address) {
            Address::create($address);
        }
    }
}
