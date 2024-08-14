<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('experience_level_id')->nullable()->constrained('experience_levels')->onDelete('cascade');
            $table->foreignId('family_status_id')->nullable()->constrained('family_status')->onDelete('cascade');
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained('positions')->onDelete('cascade');
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['experience_level_id', 'family_status_id', 'nationality_id', 'position_id', 'contract_id']);
        });
    }
};
