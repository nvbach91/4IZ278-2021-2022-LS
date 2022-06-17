<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'role' => 'admin',
                'first_name' => 'Daniel',
                'last_name' => 'Hejna',
                'phone' => '774 416 609',
                'email' => 'hejna@yeetzone.com',
                'password' => Hash::make("xxxxx"),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
