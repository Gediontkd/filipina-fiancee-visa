<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'developerindiit01@gmail.com')->exists()) {
        	User::create([
                'name' => 'Developer',
                'email' => 'developerindiit01@gmail.com',
                'password' => Hash::make('Developer@123'),
            ]);
        }       
    }
}
