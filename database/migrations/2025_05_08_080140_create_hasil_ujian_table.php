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
        Schema::create('hasil_ujian', function (Blueprint $table) {
            $table->id('hasil_id');
            $table->decimal('nilai_total', 5, 2);
            $table->decimal('nilai_listening', 5, 2);
            $table->decimal('nilai_reading', 5, 2);
            $table->enum('status_lulus', ['lulus', 'tidak lulus'])->nullable();
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal');
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_ujian');
    }
};
