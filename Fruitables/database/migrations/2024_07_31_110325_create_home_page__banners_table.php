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
        Schema::create('home_page__banners', function (Blueprint $table) {
            $table->id();
            $table->string('Banner_image')->nullable();
            $table->string('Banner_Title')->nullable();
            $table->longText('Banner_Desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page__banners');
    }
};
