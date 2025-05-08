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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('mahasiswa_id');
            $table->string('nim', 10)->unique();
            $table->string('mahasiswa_nama', 100);
            $table->string('nik', 16);
            $table->string('alamat_asal');
            $table->string('alamat_sekarang');
            $table->string('angkatan', 4);
            $table->string('no_telp', 15)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('status', ['aktif', 'alumni']);
            $table->enum('keterangan', ['gratis', 'berbayar']);
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('prodi_id')->on('prodi');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
