<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sport_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('court_number')->unique();
            $table->decimal('price_per_hour', 12, 2);
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->integer('capacity')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('sport_id');
            $table->index('status');

            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
