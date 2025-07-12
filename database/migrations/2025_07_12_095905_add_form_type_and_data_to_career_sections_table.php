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
        Schema::table('career_sections', function (Blueprint $table) {
            $table->string('form_type')->nullable()->after('career_id');
            $table->json('form_data')->nullable()->after('form_type');
            
            // Add index for form_type
            $table->index(['career_id', 'form_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_sections', function (Blueprint $table) {
            $table->dropIndex(['career_id', 'form_type']);
            $table->dropColumn(['form_type', 'form_data']);
        });
    }
};
