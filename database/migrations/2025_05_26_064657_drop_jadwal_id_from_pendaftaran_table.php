<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropJadwalIdFromPendaftaranTable extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Drop foreign key constraint and column
            $table->dropForeign(['jadwal_id']);
            $table->dropColumn('jadwal_id');
        });
    }

    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Recreate jadwal_id column and foreign key
            $table->unsignedBigInteger('jadwal_id')->nullable();
            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal')->nullOnDelete();
        });
    }
}