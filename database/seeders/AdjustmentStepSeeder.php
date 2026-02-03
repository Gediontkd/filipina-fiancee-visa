<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdjustmentStep;

class AdjustmentStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['name' => 'Name', 'slug' => 'name', 'icon' => 'fa-user'],
            ['name' => 'Place of Birth', 'slug' => 'place-of-birth', 'icon' => 'fa-map-marker-alt'],
            ['name' => 'Visa Info', 'slug' => 'visa-info', 'icon' => 'fa-passport'],
            ['name' => 'Address', 'slug' => 'address', 'icon' => 'fa-home'],
            ['name' => 'Civil Status', 'slug' => 'civil-status', 'icon' => 'fa-heart'],
            ['name' => 'Sponsor Part 1', 'slug' => 'sponsor-part-1', 'icon' => 'fa-user-tie'],
            ['name' => 'Sponsor Part 2', 'slug' => 'sponsor-part-2', 'icon' => 'fa-user-tie'],
            ['name' => 'Questions 1', 'slug' => 'questions-part-1', 'icon' => 'fa-question-circle'],
            ['name' => 'Questions 2', 'slug' => 'questions-part-2', 'icon' => 'fa-question-circle'],
            ['name' => 'Questions 3', 'slug' => 'questions-part-3', 'icon' => 'fa-question-circle'],
            ['name' => 'Questions 4', 'slug' => 'questions-part-4', 'icon' => 'fa-question-circle'],
            ['name' => 'Questions 5', 'slug' => 'questions-part-5', 'icon' => 'fa-question-circle'],
            ['name' => 'EAD', 'slug' => 'ead', 'icon' => 'fa-id-card'],
            ['name' => 'Accommodation', 'slug' => 'accommodations', 'icon' => 'fa-wheelchair'],
            ['name' => 'Interpreter', 'slug' => 'interpreter', 'icon' => 'fa-language'],
            ['name' => 'Children', 'slug' => 'children', 'icon' => 'fa-child'],
            ['name' => 'Affiliations', 'slug' => 'affiliations', 'icon' => 'fa-users'],
            ['name' => 'Alien Parents', 'slug' => 'alien-parents', 'icon' => 'fa-user-friends'],
            ['name' => 'Employment', 'slug' => 'employment', 'icon' => 'fa-briefcase'],
        ];

        foreach ($steps as $step) {
            AdjustmentStep::updateOrCreate(
                ['slug' => $step['slug']],
                $step
            );
        }

        $this->command->info('Adjustment steps seeded successfully!');
    }
}
