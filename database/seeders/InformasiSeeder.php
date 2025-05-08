<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('informasi')->insert([
            [
                'judul' => 'Pendaftaran TOEIC Dibuka!',
                'isi' => 'Segera daftarkan dirimu untuk ujian TOEIC gelombang 1.',
                'admin_id' => 1,
            ],
        ]);
    }
}
