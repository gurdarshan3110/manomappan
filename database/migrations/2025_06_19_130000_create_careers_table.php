<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('cluster_id')->constrained('career_clusters')->onDelete('cascade');
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->string('status')->default('DRAFT');
            $table->integer('sort_order')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();

            $table->index(['status', 'sort_order']);
            $table->index('cluster_id');
        });

        Schema::create('career_related', function (Blueprint $table) {
            $table->foreignId('career_id')->constrained()->onDelete('cascade');
            $table->foreignId('related_career_id')->constrained('careers')->onDelete('cascade');
            $table->primary(['career_id', 'related_career_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_related');
        Schema::dropIfExists('careers');
    }
};
