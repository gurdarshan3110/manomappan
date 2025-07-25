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
        Schema::create('user_has_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->constrained()->onDelete('cascade');
            $table->timestamp('activated_at')->useCurrent();
            $table->timestamp('expires_at')->nullable(); // If packages have expiration
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Ensure unique combination
            $table->unique(['user_id', 'package_id', 'payment_id']);
            
            // Indexes for better performance
            $table->index(['user_id', 'is_active']);
            $table->index('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_packages');
    }
};
