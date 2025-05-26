<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeJadwalIdNullableInPendaftaranTable extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Make jadwal_id nullable
            $table->unsignedBigInteger('jadwal_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Revert to non-nullable (note: this may fail if null values exist)
            $table->unsignedBigInteger('jadwal_id')->nullable(false)->change();
        });
    }
}