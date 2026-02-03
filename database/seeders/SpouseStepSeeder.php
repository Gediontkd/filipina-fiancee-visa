<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpouseStep;

class SpouseStepSeeder extends Seeder
{
    public function run()
    {
        // Clear existing steps
        SpouseStep::truncate();

        // Sponsor steps
        $sponsorSteps = [
            ['name' => 'Name', 'icon' => 'fa-user', 'slug' => 'name', 'type' => 'sponsor'],
            ['name' => 'Contact', 'icon' => 'fa-phone-alt', 'slug' => 'contact', 'type' => 'sponsor'],
            ['name' => 'Address', 'icon' => 'fa-home', 'slug' => 'address', 'type' => 'sponsor'],
            ['name' => 'Place of Birth', 'icon' => 'fa-map-marker-alt', 'slug' => 'place-of-birth', 'type' => 'sponsor'],
            ['name' => 'Biographic Data', 'icon' => 'fa-info-circle', 'slug' => 'status', 'type' => 'sponsor'],
            ['name' => 'Marital History', 'icon' => 'fa-heart', 'slug' => 'marital-status', 'type' => 'sponsor'],
            ['name' => 'Previous Filings', 'icon' => 'fa-file-alt', 'slug' => 'other-filings', 'type' => 'sponsor'],
            ['name' => 'Military Service', 'icon' => 'fa-shield-alt', 'slug' => 'military-convictions', 'type' => 'sponsor'],
            ['name' => 'Employment', 'icon' => 'fa-briefcase', 'slug' => 'employment', 'type' => 'sponsor'],
        ];

        // Beneficiary steps
        $beneficiarySteps = [
            ['name' => 'Name', 'icon' => 'fa-user', 'slug' => 'name', 'type' => 'beneficiary'],
            ['name' => 'Contact', 'icon' => 'fa-phone-alt', 'slug' => 'contact', 'type' => 'beneficiary'],
            ['name' => 'Address', 'icon' => 'fa-home', 'slug' => 'address', 'type' => 'beneficiary'],
            ['name' => 'Place of Birth', 'icon' => 'fa-map-marker-alt', 'slug' => 'place-of-birth', 'type' => 'beneficiary'],
            ['name' => 'Biographic Data', 'icon' => 'fa-info-circle', 'slug' => 'status', 'type' => 'beneficiary'],
            ['name' => 'Marital History', 'icon' => 'fa-heart', 'slug' => 'marital-status', 'type' => 'beneficiary'],
            ['name' => 'Employment', 'icon' => 'fa-briefcase', 'slug' => 'employment', 'type' => 'beneficiary'],
        ];

        // Shared steps (if any)
        $sharedSteps = [
            ['name' => 'Marriage Details', 'icon' => 'fa-comments', 'slug' => 'relationship', 'type' => 'shared'],
        ];

        foreach ($sponsorSteps as $step) {
            SpouseStep::create($step);
        }

        foreach ($beneficiarySteps as $step) {
            SpouseStep::create($step);
        }

        foreach ($sharedSteps as $step) {
            SpouseStep::create($step);
        }
    }
}