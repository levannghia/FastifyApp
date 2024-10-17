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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->nullable()->foreignId('delivery_partner_id')->constrained('users');
            $table->foreignId('branch_id')->constrained('branches');
            $table->json('delivery_location')->nullable();
            $table->json('pickup_location')->nullable();
            $table->json('delivery_person_location')->nullable();
            $table->enum('status', ['confirmed', 'arriving', 'available', 'delivered', 'cancelled'])->default('available');
            $table->float('total_price')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
