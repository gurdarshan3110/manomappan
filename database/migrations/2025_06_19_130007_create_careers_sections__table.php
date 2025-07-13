<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained()->onDelete('cascade');
            $table->string('section_title');
            $table->longText('section_content');
            $table->string('section_image')->nullable();
            $table->integer('section_order');
            $table->timestamps();

            $table->index(['career_id', 'section_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_sections');
    }
};
