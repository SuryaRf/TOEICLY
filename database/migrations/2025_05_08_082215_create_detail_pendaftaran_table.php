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
        Schema::create('detail_pendaftaran', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('pendaftaran_id')->unique();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak']);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pendaftaran');
    }
};
