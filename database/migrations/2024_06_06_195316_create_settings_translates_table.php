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
        Schema::create('settings_translates', function (Blueprint $table) {
            $table->id();
            $table->string('lang_key')->nullable();
            $table->string('copyright_text')->nullable();
            $table->unsignedBigInteger('settings_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_translates');
    }
};
