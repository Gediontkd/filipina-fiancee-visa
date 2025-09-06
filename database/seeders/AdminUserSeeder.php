<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user
        Admin::updateOrCreate(
            ['email' => 'admin@filipinafianceevisa.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@filipinafianceevisa.com',
                'password' => Hash::make('Admin123'),
                'role' => 'super_admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create additional admin with different email
        Admin::updateOrCreate(
            ['email' => 'support@filipinafianceevisa.com'],
            [
                'name' => 'Admin User',
                'email' => 'support@filipinafianceevisa.com',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Super Admin - Email: admin@filipinafianceevisa.com | Password: Admin123');
        $this->command->info('Admin - Email: support@filipinafianceevisa.com | Password: Admin123');
    }
}