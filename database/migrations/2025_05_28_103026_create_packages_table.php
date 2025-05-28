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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('status');
            $table->string('counsellor')->nullable();
            $table->string('language')->nullable();
            $table->string('report')->nullable();
            $table->string('ai_drive_career_support')->nullable();
            $table->string('career_counselling_session')->nullable();
            $table->string('sessions_with_role_model_and_parents')->nullable();
            $table->string('certified_expert_guidence')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
