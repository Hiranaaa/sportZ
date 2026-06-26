<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_slots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('court_id');
            $table->date('slot_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status')->default('available');
            $table->uuid('booking_id')->nullable();
            $table->timestamps();

            $table->index(['court_id', 'slot_date', 'status']);
            $table->unique(['court_id', 'slot_date', 'start_time']);

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_slots');
    }
};
