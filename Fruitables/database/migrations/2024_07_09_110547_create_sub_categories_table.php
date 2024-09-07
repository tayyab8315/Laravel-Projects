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
        Schema::dropIfExists('sub_categories');
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_name');
            $table->longText('sub_category_desc');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
        
    //     Schema::create('sub_categories', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->unsignedBigInteger('cat_id'); // Foreign key column
    //         $table->foreign('cat_id')->references('id')->on('product_categories')->onDelete('cascade');
    
    //     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
