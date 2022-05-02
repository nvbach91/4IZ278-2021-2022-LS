<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [
                'size_type' => 'S'
            ],
            [
                'size_type' => 'M'
            ],
            [
                'size_type' => 'L'
            ],
            [
                'size_type' => 'XL'
            ],
            [
                'size_type' => '90cm'
            ],
            [
                'size_type' => '95cm'
            ],
            [
                'size_type' => '100cm'
            ],
            [
                'size_type' => '105cm'
            ],
            [
                'size_type' => '110cm'
            ],
            [
                'size_type' => '115cm'
            ],
            [
                'size_type' => '120cm'
            ]
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
