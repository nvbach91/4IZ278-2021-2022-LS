<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            'administration',
            'tourism',
            'economy',
            'gastronomy',
            'it',
            'marketing',
            'security',
            'food_industry',
            'services',
            'state_services',
            'top_management',
            'production_industry',
            'agriculture',
            'auto_moto',
            'chemistry',
            'electronics',
            'it_consultation',
            'culture',
            'media_hr_advertising',
            'hr',
            'sales',
            'construction',
            'development',
            'publishing',
            'science',
            'customer_service',
            'banking',
            'logistics',
            'pharmacy',
            'it_management',
            'quality_control',
            'purchase',
            'legal',
            'insurance',
            'engineering',
            'telecommunication',
            'education',
            'healthcare',
            'craft',
        ];

        foreach ($branches as $branch) {
            $model = new Branch();
            $model->name = $branch;
            $model->save();
        }
    }
}
