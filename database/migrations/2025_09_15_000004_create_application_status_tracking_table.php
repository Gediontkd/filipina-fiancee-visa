
<?php
// database/migrations/2025_09_15_000004_create_application_status_tracking_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('application_status_tracking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->enum('status', [
                'payment_received', 
                'in_review', 
                'filling_forms', 
                'ready_for_signature', 
                'ready_to_mail',
                'completed'
            ]);
            $table->timestamp('status_changed_at');
            $table->unsignedBigInteger('changed_by');
            $table->text('notes')->nullable();
            $table->timestamp('estimated_completion')->nullable();
            $table->timestamps();
            
            $table->foreign('application_id')->references('id')->on('user_submitted_applications')->onDelete('cascade');
            $table->foreign('changed_by')->references('id')->on('admins')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('application_status_tracking');
    }
};