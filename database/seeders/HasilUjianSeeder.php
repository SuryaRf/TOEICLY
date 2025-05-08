<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilUjianSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hasil_ujian')->insert([
            [
                'nilai_total' => 850.00,
                'nilai_listening' => 450.00,
                'nilai_reading' => 400.00,
                'status_lulus' => 'lulus',
                'catatan' => 'Hasil sangat baik',
                'jadwal_id' => 1,
                'user_id' => 2,
            ],
        ]);
    }
}
