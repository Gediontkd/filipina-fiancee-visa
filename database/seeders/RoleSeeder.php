<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // if (!Role::where('name', 'user')->exists()) {
        // 	Role::create(['name' => 'user']);
        // }       
    }
}
