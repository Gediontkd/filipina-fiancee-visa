<?php
// Create migration: php artisan make:migration add_admin_fields_to_user_submitted_applications_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            // Status field already exists, so we don't add it
            
            if (!Schema::hasColumn('user_submitted_applications', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('user_submitted_applications', 'reviewed_at')) {
                $table->timestamp('reviewed_at')->nullable()->after('admin_notes');
            }
            
            if (!Schema::hasColumn('user_submitted_applications', 'reviewed_by')) {
                $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
                $table->foreign('reviewed_by')->references('id')->on('admins')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn(['status', 'admin_notes', 'reviewed_at', 'reviewed_by']);
        });
    }
};