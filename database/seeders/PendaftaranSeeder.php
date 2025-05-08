<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pendaftaran')->insert([
            [
                'pendaftaran_kode' => 'P001',
                'tanggal_pendaftaran' => now(),
                'scan_ktp' => 'ktp1.jpg',
                'scan_ktm' => 'ktm1.jpg',
                'pas_foto' => 'foto1.jpg',
                'mahasiswa_id' => 1,
                'jadwal_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
