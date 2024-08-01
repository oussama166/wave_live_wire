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
        Schema::table('leaves', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained("users")->onDelete('cascade');
            $table->foreignId('vacation_type_id')->nullable()->constrained('vacation_types')->onDelete('cascade');
            $table->foreignId('leave_status_id')->nullable()->constrained('leave_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'vacation_type_id', 'leave_status_id']);
        });
    }
};
