<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal')->insert([
            [
                'tanggal_pelaksanaan' => '2025-06-15 09:00:00',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '11:00:00',
                'keterangan' => 'Jadwal Ujian Gelombang 1',
            ],
        ]);
    }
}
