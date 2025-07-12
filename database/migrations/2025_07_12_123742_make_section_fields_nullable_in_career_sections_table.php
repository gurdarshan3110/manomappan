<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_sections', function (Blueprint $table) {
            $table->string('section_title')->nullable()->change();
            $table->text('section_content')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('career_sections', function (Blueprint $table) {
            $table->string('section_title')->nullable(false)->change();
            $table->text('section_content')->nullable(false)->change();
        });
    }
};
