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
        Schema::create('schedule_batch_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('schedule_batches')->onDelete('cascade');
            $table->integer('day_index'); // 0 = primer día, 1 = segundo día, etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_batch_slots');
    }
};