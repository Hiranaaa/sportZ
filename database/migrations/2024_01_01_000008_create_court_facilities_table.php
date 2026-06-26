<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('court_facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('court_id');
            $table->uuid('facility_id');
            $table->timestamps();

            $table->unique(['court_id', 'facility_id']);

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->cascadeOnDelete();

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('court_facilities');
    }
};
