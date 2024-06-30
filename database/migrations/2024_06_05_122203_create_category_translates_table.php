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
        Schema::create('category_translates', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_first')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('title_second')->nullable();
            $table->text('text_first')->nullable();
            $table->text(' text_second ')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('lang_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_translates');
    }
};
