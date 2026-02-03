<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FianceStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data to avoid duplicates
        DB::table('fiance_steps')->truncate();

        $steps = [
            // Sponsor steps
            [
                'name' => 'name',
                'slug' => 'name',
                'icon' => 'fa-user',
                'type' => 'sponsor',
            ],
            [
                'name' => 'contact',
                'slug' => 'contact',
                'icon' => 'fa-phone',
                'type' => 'sponsor',
            ],
            [
                'name' => 'place-of-birth',
                'slug' => 'place-of-birth',
                'icon' => 'fa-map-marker',
                'type' => 'sponsor',
            ],
            [
                'name' => 'status',
                'slug' => 'status',
                'icon' => 'fa-info-circle',
                'type' => 'sponsor',
            ],
            [
                'name' => 'marital-status',
                'slug' => 'marital-status',
                'icon' => 'fa-heart',
                'type' => 'sponsor',
            ],
            [
                'name' => 'other-filings',
                'slug' => 'other-filings',
                'icon' => 'fa-file-alt',
                'type' => 'sponsor',
            ],
            [
                'name' => 'military-and-convictions',
                'slug' => 'military-and-convictions',
                'icon' => 'fa-shield-alt',
                'type' => 'sponsor',
            ],
            [
                'name' => 'address',
                'slug' => 'address',
                'icon' => 'fa-home',
                'type' => 'sponsor',
            ],
            [
                'name' => 'relationship',
                'slug' => 'relationship',
                'icon' => 'fa-users',
                'type' => 'sponsor',
            ],
            [
                'name' => 'employment',
                'slug' => 'employment',
                'icon' => 'fa-briefcase',
                'type' => 'sponsor',
            ],
            // Alien steps
            [
                'name' => 'name',
                'slug' => 'name',
                'icon' => 'fa-user',
                'type' => 'alien',
            ],
            [
                'name' => 'citizenship',
                'slug' => 'citizenship',
                'icon' => 'fa-flag',
                'type' => 'alien',
            ],
            [
                'name' => 'embassy',
                'slug' => 'embassy',
                'icon' => 'fa-building',
                'type' => 'alien',
            ],
            [
                'name' => 'contact',
                'slug' => 'contact',
                'icon' => 'fa-phone',
                'type' => 'alien',
            ],
            [
                'name' => 'marital-status',
                'slug' => 'marital-status',
                'icon' => 'fa-heart',
                'type' => 'alien',
            ],
            [
                'name' => 'parents',
                'slug' => 'parents',
                'icon' => 'fa-users',
                'type' => 'alien',
            ],
            [
                'name' => 'visited-us',
                'slug' => 'visited-us',
                'icon' => 'fa-plane',
                'type' => 'alien',
            ],
            [
                'name' => 'address',
                'slug' => 'address',
                'icon' => 'fa-home',
                'type' => 'alien',
            ],
            [
                'name' => 'employment',
                'slug' => 'employment',
                'icon' => 'fa-briefcase',
                'type' => 'alien',
            ],
            [
                'name' => 'travel',
                'slug' => 'travel',
                'icon' => 'fa-plane',
                'type' => 'alien',
            ],
            [
                'name' => 'military',
                'slug' => 'military',
                'icon' => 'fa-shield-alt',
                'type' => 'alien',
            ],
            [
                'name' => 'activity',
                'slug' => 'activity',
                'icon' => 'fa-tasks',
                'type' => 'alien',
            ],
            [
                'name' => 'immigration',
                'slug' => 'immigration',
                'icon' => 'fa-passport',
                'type' => 'alien',
            ],
            [
                'name' => 'languages',
                'slug' => 'languages',
                'icon' => 'fa-language',
                'type' => 'alien',
            ],
            [
                'name' => 'relatives',
                'slug' => 'relatives',
                'icon' => 'fa-users',
                'type' => 'alien',
            ],
            [
                'name' => 'question1',
                'slug' => 'question1',
                'icon' => 'fa-question',
                'type' => 'alien',
            ],
            [
                'name' => 'question2',
                'slug' => 'question2',
                'icon' => 'fa-question',
                'type' => 'alien',
            ],
            [
                'name' => 'question3',
                'slug' => 'question3',
                'icon' => 'fa-question',
                'type' => 'alien',
            ],
            [
                'name' => 'question4',
                'slug' => 'question4',
                'icon' => 'fa-question',
                'type' => 'alien',
            ],
            [
                'name' => 'question5',
                'slug' => 'question5',
                'icon' => 'fa-question',
                'type' => 'alien',
            ],
            // Children steps
            [
                'name' => 'child1',
                'slug' => 'child-1',
                'icon' => 'fa-child',
                'type' => 'alien-children',
            ],
            [
                'name' => 'child2',
                'slug' => 'child-2',
                'icon' => 'fa-child',
                'type' => 'alien-children',
            ],
            [
                'name' => 'child3',
                'slug' => 'child-3',
                'icon' => 'fa-child',
                'type' => 'alien-children',
            ],
            [
                'name' => 'child4',
                'slug' => 'child-4',
                'icon' => 'fa-child',
                'type' => 'alien-children',
            ],
            [
                'name' => 'child5',
                'slug' => 'child-5',
                'icon' => 'fa-child',
                'type' => 'alien-children',
            ],
        ];

        DB::table('fiance_steps')->insert($steps);
    }
}