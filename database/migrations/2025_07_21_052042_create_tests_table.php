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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index(); // e.g., 'mz_6_section_aptitude_test'
            $table->string('display_name'); // e.g., 'Mz Potential Profile'
            $table->string('language')->index(); // e.g., 'English', 'Bengali', etc.
            $table->integer('price_counselor')->default(0); // Price for counselor
            $table->integer('price_counselee')->default(0); // Price for counselee
            $table->integer('counter_counselor')->default(0); // Usage counter for counselor
            $table->integer('counter_counselee')->default(0); // Usage counter for counselee
            $table->boolean('activated')->default(true)->index(); // Whether test is active
            $table->string('external_id')->nullable()->unique(); // External MongoDB ID for sync
            $table->timestamps();

            // Add composite indexes for common queries
            $table->index(['name', 'language']);
            $table->index(['activated', 'language']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
