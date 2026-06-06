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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('branch')->nullable();
            $table->string('date_of_birth')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('organization');
            $table->dropColumn('designation');
            $table->dropColumn('department');
            $table->dropColumn('branch');
            $table->dropColumn('date_of_birth');
        });
    }
};
