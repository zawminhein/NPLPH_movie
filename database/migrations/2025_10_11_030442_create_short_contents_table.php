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
        Schema::create('short_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable(false);
            $table->string('title_mm')->nullable();
            $table->text('desc_en')->nullable(false);
            $table->text('desc_mm')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_contents');
    }
};
