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
        Schema::create('ujian', function (Blueprint $table) {
            $table->id('ujian_id');
            $table->string('ujian_kode', 10);
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('pendaftaran_id');

            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal');
            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian');
    }
};
