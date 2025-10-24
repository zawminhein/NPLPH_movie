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
        Schema::create('upcoming_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable(false);
            $table->string('title_mm')->nullable();
            $table->text('image_url')->nullable();
            $table->text('bg_image_url')->nullable();
            $table->text('short_desc_en')->nullable(false);
            $table->text('short_desc_mm')->nullable();
            $table->text('long_desc_en')->nullable(false);//{editor}
            $table->text('long_desc_mm')->nullable();//{editor}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcoming_contents');
    }
};
