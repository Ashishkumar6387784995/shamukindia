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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('service_type');
            $table->string('purpose');
            $table->string('borrower_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('city')->nullable();
            $table->string('remarks')->nullable();
            $table->longText('documents')->nullable();
            $table->integer('status')->default(0)->comment('0 = Request Received, 1 = Inspection Scheduled, 2 = Hold, 3 = Inspection Rescheduled, 4 = Cancelled, 5 = Executive Appointed, 6 = Physical Inspection Done, 7 = Documents Pending, 8 = Document & Payment Awaited, 9 = Report Under Analysis, 10 = Payment Awaited');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
