<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFianceVisaTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_fiance_visa_types', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->enum('type', ['sponsor', 'alien', 'alien-children'])->nullable();
            $table->enum('status', ['in-progress', 'completed'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_fiance_visa_types');
    }
}
