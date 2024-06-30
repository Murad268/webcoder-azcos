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
        Schema::create('team_translates', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('position')->nullable();
            $table->text('text')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->string('lang_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_translates');
    }
};
