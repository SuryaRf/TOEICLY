<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_sertifikat', function (Blueprint $table) {
            $table->date('tanggal')->after('file_pdf')->nullable();
            // nullable supaya data lama tidak bermasalah saat migrasi
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_sertifikat', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });
    }
};
