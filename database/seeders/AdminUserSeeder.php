<?php
// database/seeders/AdminUserSeeder.php
// Run: php artisan make:seeder AdminUserSeeder

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
        // Create default admin user
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

        // Create additional admin if needed
        Admin::updateOrCreate(
            ['email' => 'admin@filipinafianceevisa.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@filipinafianceevisa.com',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Email: admin@filipinafianceevisa.com | Password: Admin123');
        $this->command->info('Email: admin@filipinafianceevisa.com | Password: Admin123');
    }
}