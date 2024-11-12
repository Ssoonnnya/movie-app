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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title_uk');
            $table->string('title_en');
            $table->text('description_uk');
            $table->text('description_en');
            $table->string('poster');
            $table->json('screenshots')->nullable();
            $table->string('youtube_trailer_id');
            $table->year('release_year');
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
