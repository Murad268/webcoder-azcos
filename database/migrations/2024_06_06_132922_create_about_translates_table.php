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
        Schema::create('about_translates', function (Blueprint $table) {
            $table->id();
            $table->string('title_first')->nullable();
            $table->string('text_first')->nullable();
            $table->string('title_second')->nullable();
            $table->string('text_second')->nullable();
            $table->string('title_third')->nullable();
            $table->string('text_third')->nullable();
            $table->string('lang_key')->nullable();
            $table->unsignedBigInteger('about_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_translates');
    }
};
