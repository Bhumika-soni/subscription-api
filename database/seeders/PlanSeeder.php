<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Basic Plan',
            'price' => 399.00,
            'duration' => 30,
        ]);

        Plan::create([
            'name' => 'Premium Plan',
            'price' => 599.00,
            'duration' => 100,
        ]);

        Plan::create([
            'name' => 'Annual Plan',
            'price' => 799.00,
            'duration' => 365,
        ]);
    }
}
