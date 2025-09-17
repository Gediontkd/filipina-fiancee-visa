<?php
// database/seeders/VisaApplicationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisaApplication;

class VisaApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visaApplications = [
            [
                'name' => 'Fiance Visa',
                'description' => 'K-1 Fiance Visa Application',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spouse Visa', 
                'description' => 'CR-1/IR-1 Spouse Visa Application',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adjustment of Status',
                'description' => 'I-485 Adjustment of Status Application', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($visaApplications as $app) {
            VisaApplication::firstOrCreate(
                ['name' => $app['name']],
                $app
            );
        }

        $this->command->info('Visa applications created successfully!');
    }
}