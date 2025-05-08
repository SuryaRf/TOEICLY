<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insert([
            ['prodi_kode' => 'TRPL', 'prodi_nama' => 'Teknologi Rekayasa Perangkat Lunak', 'jurusan_id' => 1],
            ['prodi_kode' => 'MI', 'prodi_nama' => 'Manajemen Informatika', 'jurusan_id' => 1],
        ]);
    }
}
