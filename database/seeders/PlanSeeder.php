<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plans;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plans::updateOrCreate(
            [
                'id' => 1,
                'name' => 'free',
                'slug' => 'free',
            ],
            [
                'price' => 0,
                'is_paid' => false,
            ]
        );

        Plans::updateOrCreate(
            [
                'id' => 2,
                'name' => 'premium',
                'slug' => 'premium',
            ],
            [
                'price' => 49.90,
                'is_paid' => true,
            ]
        );
    }
}
