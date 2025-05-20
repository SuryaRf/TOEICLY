<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_sertifikat', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->string('judul', 100);
            $table->string('file_pdf')->nullable(); // path file PDF jadwal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_sertifikat');
    }
};
