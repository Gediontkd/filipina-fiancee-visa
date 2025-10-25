<?php
// database/seeders/VisaApplicationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisaApplication;

class VisaApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $visaApplications = [
            ['id' => 1, 'name' => 'Fiance Visa'],
            ['id' => 2, 'name' => 'Adjustment of Status'],
            ['id' => 3, 'name' => 'Spouse Visa'],
            ['id' => 4, 'name' => 'Combined CR-1 + AOS'],
        ];

        foreach ($visaApplications as $app) {
            VisaApplication::updateOrCreate(
                ['id' => $app['id']],
                [
                    'name' => $app['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Visa applications seeded successfully!');
    }
}