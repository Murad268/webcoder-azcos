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
        Schema::create('color_shemes_translates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('color_shemes_id');
            $table->string('lang_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_shemes_translates');
    }
};
