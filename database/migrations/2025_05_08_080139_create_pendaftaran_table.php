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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('pendaftaran_id');
            $table->string('pendaftaran_kode', 10);
            $table->dateTime('tanggal_pendaftaran');
            $table->string('scan_ktp');
            $table->string('scan_ktm');
            $table->string('pas_foto');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa');
            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
