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
        // Migration untuk tabel sertifikat_status
        Schema::create('sertifikat_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id')->unique();
            $table->enum('status', ['belum', 'sudah'])->default('belum');
            $table->timestamps();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
