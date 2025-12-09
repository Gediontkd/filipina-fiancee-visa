<?php
// database/migrations/2025_12_09_215742_add_foreign_key_to_user_submitted_applications.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        echo "Starting migration...\n";
        
        // Step 1: Clean up orphaned records
        echo "Step 1: Checking for orphaned records...\n";
        $orphanedCount = DB::table('user_submitted_applications')
            ->whereNotIn('user_id', function($query) {
                $query->select('id')->from('users');
            })
            ->count();
        
        if ($orphanedCount > 0) {
            echo "Found {$orphanedCount} orphaned records. Deleting...\n";
            DB::table('user_submitted_applications')
                ->whereNotIn('user_id', function($query) {
                    $query->select('id')->from('users');
                })
                ->delete();
            echo "✓ Deleted {$orphanedCount} orphaned records\n";
        } else {
            echo "✓ No orphaned records found\n";
        }
        
        // Step 2: Clean up invalid reviewed_by references
        echo "Step 2: Cleaning up invalid reviewed_by references...\n";
        $updatedCount = DB::table('user_submitted_applications')
            ->whereNotNull('reviewed_by')
            ->whereNotIn('reviewed_by', function($query) {
                $query->select('id')->from('admins');
            })
            ->update(['reviewed_by' => null, 'reviewed_at' => null]);
        
        if ($updatedCount > 0) {
            echo "✓ Cleaned up {$updatedCount} invalid reviewed_by references\n";
        } else {
            echo "✓ No invalid reviewed_by references found\n";
        }
        
        // Step 3: Disable foreign key checks
        echo "Step 3: Disabling foreign key checks...\n";
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Step 4: Modify column types using raw SQL
        echo "Step 4: Modifying user_id column to BIGINT UNSIGNED...\n";
        DB::statement('ALTER TABLE user_submitted_applications 
                       MODIFY COLUMN user_id BIGINT UNSIGNED NOT NULL');
        echo "✓ user_id column modified successfully\n";
        
        // Modify reviewed_by column if it exists
        echo "Step 5: Modifying reviewed_by column to BIGINT UNSIGNED...\n";
        try {
            DB::statement('ALTER TABLE user_submitted_applications 
                           MODIFY COLUMN reviewed_by BIGINT UNSIGNED NULL');
            echo "✓ reviewed_by column modified successfully\n";
        } catch (\Exception $e) {
            echo "! reviewed_by column modification skipped (column may not exist)\n";
        }
        
        // Step 6: Add foreign key for user_id
        echo "Step 6: Adding foreign key constraint for user_id...\n";
        try {
            DB::statement('ALTER TABLE user_submitted_applications 
                           ADD CONSTRAINT user_submitted_applications_user_id_foreign 
                           FOREIGN KEY (user_id) REFERENCES users(id) 
                           ON DELETE CASCADE');
            echo "✓ Foreign key for user_id added successfully\n";
        } catch (\Exception $e) {
            echo "! Foreign key for user_id already exists or failed: " . $e->getMessage() . "\n";
        }
        
        // Step 7: Add foreign key for reviewed_by
        echo "Step 7: Adding foreign key constraint for reviewed_by...\n";
        try {
            DB::statement('ALTER TABLE user_submitted_applications 
                           ADD CONSTRAINT user_submitted_applications_reviewed_by_foreign 
                           FOREIGN KEY (reviewed_by) REFERENCES admins(id) 
                           ON DELETE SET NULL');
            echo "✓ Foreign key for reviewed_by added successfully\n";
        } catch (\Exception $e) {
            echo "! Foreign key for reviewed_by skipped: " . $e->getMessage() . "\n";
        }
        
        // Step 8: Re-enable foreign key checks
        echo "Step 8: Re-enabling foreign key checks...\n";
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        echo "\n✓✓✓ Migration completed successfully! ✓✓✓\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        echo "Rolling back migration...\n";
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Drop foreign keys
        echo "Dropping foreign key constraints...\n";
        try {
            DB::statement('ALTER TABLE user_submitted_applications 
                           DROP FOREIGN KEY user_submitted_applications_user_id_foreign');
            echo "✓ Dropped foreign key for user_id\n";
        } catch (\Exception $e) {
            echo "! Foreign key for user_id not found\n";
        }
        
        try {
            DB::statement('ALTER TABLE user_submitted_applications 
                           DROP FOREIGN KEY user_submitted_applications_reviewed_by_foreign');
            echo "✓ Dropped foreign key for reviewed_by\n";
        } catch (\Exception $e) {
            echo "! Foreign key for reviewed_by not found\n";
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        echo "✓ Rollback completed\n";
    }
};