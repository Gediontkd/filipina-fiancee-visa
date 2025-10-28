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
            ['name' => 'Name', 'icon' => 'user-icon.png', 'slug' => 'name', 'type' => 'sponsor'],
            ['name' => 'Contact', 'icon' => 'contact-icon.png', 'slug' => 'contact', 'type' => 'sponsor'],
            ['name' => 'Address', 'icon' => 'address-icon.png', 'slug' => 'address', 'type' => 'sponsor'],
            ['name' => 'Place of Birth', 'icon' => 'birth-icon.png', 'slug' => 'place-of-birth', 'type' => 'sponsor'],
            ['name' => 'Biographic Data', 'icon' => 'status-icon.png', 'slug' => 'status', 'type' => 'sponsor'],
            ['name' => 'Marital History', 'icon' => 'marital-icon.png', 'slug' => 'marital-status', 'type' => 'sponsor'],
            ['name' => 'Previous Filings', 'icon' => 'filing-icon.png', 'slug' => 'other-filings', 'type' => 'sponsor'],
            ['name' => 'Military Service', 'icon' => 'military-icon.png', 'slug' => 'military-convictions', 'type' => 'sponsor'],
            ['name' => 'Employment', 'icon' => 'employment-icon.png', 'slug' => 'employment', 'type' => 'sponsor'],
        ];

        // Beneficiary steps
        $beneficiarySteps = [
            ['name' => 'Name', 'icon' => 'user-icon.png', 'slug' => 'name', 'type' => 'beneficiary'],
            ['name' => 'Contact', 'icon' => 'contact-icon.png', 'slug' => 'contact', 'type' => 'beneficiary'],
            ['name' => 'Address', 'icon' => 'address-icon.png', 'slug' => 'address', 'type' => 'beneficiary'],
            ['name' => 'Place of Birth', 'icon' => 'birth-icon.png', 'slug' => 'place-of-birth', 'type' => 'beneficiary'],
            ['name' => 'Biographic Data', 'icon' => 'status-icon.png', 'slug' => 'status', 'type' => 'beneficiary'],
            ['name' => 'Marital History', 'icon' => 'marital-icon.png', 'slug' => 'marital-status', 'type' => 'beneficiary'],
            ['name' => 'Employment', 'icon' => 'employment-icon.png', 'slug' => 'employment', 'type' => 'beneficiary'],
        ];

        // Shared steps (if any)
        $sharedSteps = [
            ['name' => 'Marriage Details', 'icon' => 'relationship-icon.png', 'slug' => 'relationship', 'type' => 'shared'],
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