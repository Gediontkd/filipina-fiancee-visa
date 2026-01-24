<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['id' => 231, 'name' => 'United States', 'sortname' => 'US', 'phonecode' => '1'],
            ['name' => 'Philippines', 'sortname' => 'PH', 'phonecode' => '63'],
            ['name' => 'Canada', 'sortname' => 'CA', 'phonecode' => '1'],
            ['name' => 'United Kingdom', 'sortname' => 'GB', 'phonecode' => '44'],
            ['name' => 'Australia', 'sortname' => 'AU', 'phonecode' => '61'],
            ['name' => 'Germany', 'sortname' => 'DE', 'phonecode' => '49'],
            ['name' => 'France', 'sortname' => 'FR', 'phonecode' => '33'],
            ['name' => 'Japan', 'sortname' => 'JP', 'phonecode' => '81'],
            ['name' => 'China', 'sortname' => 'CN', 'phonecode' => '86'],
            ['name' => 'India', 'sortname' => 'IN', 'phonecode' => '91'],
            // Add more countries as needed
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}