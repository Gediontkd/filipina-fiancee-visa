
<?php
// database/migrations/2025_09_15_000005_add_payment_status_to_user_submitted_applications.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'partial', 'completed'])->default('pending')->after('status');
            $table->decimal('total_amount', 10, 2)->nullable()->after('payment_status');
            $table->decimal('paid_amount', 10, 2)->default(0)->after('total_amount');
        });
    }
    
    public function down()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'total_amount', 'paid_amount']);
        });
    }
};