<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lead_status_changes', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('lead_id'); 
            $table->string('status'); 
            $table->dateTime('appointed_date_time')->nullable();
            $table->string('appointed_place')->nullable(); 
            $table->string('professional_fees')->nullable(); 
            $table->string('select_mode_of_payment')->nullable(); 
            $table->string('executive_charges')->nullable(); 
            $table->longText('remarks')->nullable(); 
            $table->string('select_executive')->nullable(); 
            $table->longText('executive_message')->nullable(); 
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_status_changes');
    }
};
