<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('court_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('court_id');
            $table->string('image_path');
            $table->string('image_url')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('court_images');
    }
};
