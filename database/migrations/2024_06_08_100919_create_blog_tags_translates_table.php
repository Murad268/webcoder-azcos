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
        Schema::create('blog_tags_translates', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->string('lang_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_tags_translates');
    }
};
