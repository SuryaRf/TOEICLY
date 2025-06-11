<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jurusan')->insert([
            [
                'jurusan_kode' => 'TI',
                'jurusan_nama' => 'Teknologi Informasi',
                'kampus_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan_kode' => 'EL',
                'jurusan_nama' => 'Elektronika',
                'kampus_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan_kode' => 'TM',
                'jurusan_nama' => 'Teknik Mesin',
                'kampus_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan_kode' => 'AK',
                'jurusan_nama' => 'Akuntansi',
                'kampus_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan_kode' => 'TS',
                'jurusan_nama' => 'Teknik Sipil',
                'kampus_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan_kode' => 'TK',
                'jurusan_nama' => 'Teknik Kimia',
                'kampus_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jurusan_kode' => 'AN',
                'jurusan_nama' => 'Administrasi Niaga',
                'kampus_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}