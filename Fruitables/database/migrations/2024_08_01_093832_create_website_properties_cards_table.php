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
        Schema::create('website_properties_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('Description'); // Change to longText for larger content
            $table->text('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_properties_cards');
    }
};
