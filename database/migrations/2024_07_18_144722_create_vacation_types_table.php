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
        Schema::create('vacation_types', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->longText('description')->nullable();
            $table->boolean('isPaid')->default(false);
            $table->integer('duration')->default(1);
            $table->integer('reduction')->default(0);
            $table->string('backgroundColor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacation_types');
    }
};
