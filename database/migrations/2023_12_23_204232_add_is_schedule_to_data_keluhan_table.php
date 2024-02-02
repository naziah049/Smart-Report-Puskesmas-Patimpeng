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
        Schema::table('data_keluhan', function (Blueprint $table) {
            $table->char('is_schedule', 1)->after('is_reading')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_keluhan', function (Blueprint $table) {
            $table->dropColumn('is_schedule');
        });
    }
};
