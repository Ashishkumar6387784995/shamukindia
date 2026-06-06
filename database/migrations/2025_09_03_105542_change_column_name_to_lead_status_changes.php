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
        Schema::table('lead_status_changes', function (Blueprint $table) {
            $table->renameColumn('select_mode_of_payment', 'mode_of_payment');
            $table->renameColumn('select_executive', 'executive_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_status_changes', function (Blueprint $table) {
            $table->renameColumn('mode_of_payment', 'select_mode_of_payment');
            $table->renameColumn('executive_id', 'select_executive');
        });
    }
};
