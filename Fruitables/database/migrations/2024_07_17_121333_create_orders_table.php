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
                $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->references('id')->on('products')->onDelete('cascade');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('company_name')->nullable();
                $table->string('address');
                $table->string('city');
                $table->string('country');
                $table->string('postcode', 20);
                $table->string('mobile', 20);
                $table->string('email');
                $table->string('order_number')->nullable(); 
                $table->timestamp('order_confirmed_at')->nullable();
                $table->boolean('ship_to_different_address')->nullable();
                $table->string('order_status'); 
                $table->string('payment_method');
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
