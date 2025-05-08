<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UjianSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ujian')->insert([
            [
                'ujian_kode' => 'U001',
                'jadwal_id' => 1,
                'pendaftaran_id' => 1,
            ],
        ]);
    }
}
