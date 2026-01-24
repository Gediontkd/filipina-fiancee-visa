<?php
// database/seeders/CombinedCr1AosStepSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CombinedCr1AosStep;

class CombinedCr1AosStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            // Part 1: Petitioner (U.S. Sponsor) Info
            ['id' => 1, 'name' => 'Petitioner Name', 'slug' => 'petitioner-name', 'icon' => 'stepicon1.png', 'order' => 1],
            ['id' => 2, 'name' => 'Petitioner Contact', 'slug' => 'petitioner-contact', 'icon' => 'stepicon2.png', 'order' => 2],
            ['id' => 3, 'name' => 'Petitioner Birth', 'slug' => 'petitioner-birth', 'icon' => 'stepicon3.png', 'order' => 3],
            ['id' => 4, 'name' => 'Petitioner Status', 'slug' => 'petitioner-status', 'icon' => 'stepicon4.png', 'order' => 4],
            ['id' => 5, 'name' => 'Petitioner Address', 'slug' => 'petitioner-address', 'icon' => 'stepicon5.png', 'order' => 5],
            ['id' => 6, 'name' => 'Petitioner Employment', 'slug' => 'petitioner-employment', 'icon' => 'stepicon6.png', 'order' => 6],
            
            // Part 2: Beneficiary (Foreign Spouse) Info
            ['id' => 7, 'name' => 'Spouse Name', 'slug' => 'spouse-name', 'icon' => 'stepicon7.png', 'order' => 7],
            ['id' => 8, 'name' => 'Spouse Birth', 'slug' => 'spouse-birth', 'icon' => 'stepicon8.png', 'order' => 8],
            ['id' => 9, 'name' => 'Spouse Entry Info', 'slug' => 'spouse-entry', 'icon' => 'stepicon9.png', 'order' => 9],
            ['id' => 10, 'name' => 'Spouse Address', 'slug' => 'spouse-address', 'icon' => 'stepicon10.png', 'order' => 10],
            
            // Part 3: Marriage & Relationship
            ['id' => 11, 'name' => 'Marriage Details', 'slug' => 'marriage-details', 'icon' => 'stepicon1.png', 'order' => 11],
            ['id' => 12, 'name' => 'Relationship Story', 'slug' => 'relationship-story', 'icon' => 'stepicon2.png', 'order' => 12],
            
            // Part 4: AOS Specific
            ['id' => 13, 'name' => 'AOS Questions Part 1', 'slug' => 'aos-questions-1', 'icon' => 'stepicon3.png', 'order' => 13],
            ['id' => 14, 'name' => 'AOS Questions Part 2', 'slug' => 'aos-questions-2', 'icon' => 'stepicon4.png', 'order' => 14],
            ['id' => 15, 'name' => 'Work Authorization', 'slug' => 'work-authorization', 'icon' => 'stepicon5.png', 'order' => 15],
        ];

        foreach ($steps as $step) {
            CombinedCr1AosStep::updateOrCreate(
                ['id' => $step['id']],
                $step
            );
        }

        $this->command->info('Combined CR-1 + AOS steps created successfully!');
    }
}