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
        Schema::table('exceptional_leave_balance',function (Blueprint $table){
            $table->foreignId('admin_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exceptional_leave_balance',function (Blueprint $table){
            $table->dropForeign(['user_id','admin_id']);
        });

    }
};
