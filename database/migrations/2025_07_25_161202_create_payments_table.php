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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('payment_id')->unique(); // Razorpay payment ID
            $table->string('order_id'); // Razorpay order ID
            $table->decimal('amount', 10, 2); // Amount in rupees
            $table->string('currency', 3)->default('INR');
            $table->string('status'); // Payment status from Razorpay
            $table->string('payment_method')->nullable(); // card, netbanking, upi, etc.
            $table->string('package_name'); // Package name at time of purchase
            $table->decimal('fee', 10, 2)->nullable(); // Razorpay fee
            $table->string('contact')->nullable(); // Customer contact
            $table->string('email')->nullable(); // Customer email
            $table->string('card_id')->nullable(); // Card ID if payment via card
            $table->boolean('international')->default(false); // International payment flag
            $table->json('payment_response')->nullable(); // Full Razorpay response
            $table->timestamp('payment_created_at')->nullable(); // Razorpay payment creation time
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['user_id', 'status']);
            $table->index('payment_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
