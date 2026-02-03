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
            ['id' => 1, 'name' => 'Petitioner Name', 'slug' => 'petitioner-name', 'icon' => 'fa-user', 'order' => 1],
            ['id' => 2, 'name' => 'Petitioner Contact', 'slug' => 'petitioner-contact', 'icon' => 'fa-phone-alt', 'order' => 2],
            ['id' => 3, 'name' => 'Petitioner Birth', 'slug' => 'petitioner-birth', 'icon' => 'fa-map-marker-alt', 'order' => 3],
            ['id' => 4, 'name' => 'Petitioner Status', 'slug' => 'petitioner-status', 'icon' => 'fa-info-circle', 'order' => 4],
            ['id' => 5, 'name' => 'Petitioner Address', 'slug' => 'petitioner-address', 'icon' => 'fa-home', 'order' => 5],
            ['id' => 6, 'name' => 'Petitioner Employment', 'slug' => 'petitioner-employment', 'icon' => 'fa-briefcase', 'order' => 6],
            
            // Part 2: Beneficiary (Foreign Spouse) Info
            ['id' => 7, 'name' => 'Spouse Name', 'slug' => 'spouse-name', 'icon' => 'fa-user-friends', 'order' => 7],
            ['id' => 8, 'name' => 'Spouse Birth', 'slug' => 'spouse-birth', 'icon' => 'fa-map-marker-alt', 'order' => 8],
            ['id' => 9, 'name' => 'Spouse Entry Info', 'slug' => 'spouse-entry', 'icon' => 'fa-plane-arrival', 'order' => 9],
            ['id' => 10, 'name' => 'Spouse Address', 'slug' => 'spouse-address', 'icon' => 'fa-home', 'order' => 10],
            
            // Part 3: Marriage & Relationship
            ['id' => 11, 'name' => 'Marriage Details', 'slug' => 'marriage-details', 'icon' => 'fa-heart', 'order' => 11],
            ['id' => 12, 'name' => 'Relationship Story', 'slug' => 'relationship-story', 'icon' => 'fa-comment-dots', 'order' => 12],
            
            // Part 4: AOS Specific
            ['id' => 13, 'name' => 'AOS Questions Part 1', 'slug' => 'aos-questions-1', 'icon' => 'fa-question-circle', 'order' => 13],
            ['id' => 14, 'name' => 'AOS Questions Part 2', 'slug' => 'aos-questions-2', 'icon' => 'fa-question-circle', 'order' => 14],
            ['id' => 15, 'name' => 'Work Authorization', 'slug' => 'work-authorization', 'icon' => 'fa-file-signature', 'order' => 15],
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