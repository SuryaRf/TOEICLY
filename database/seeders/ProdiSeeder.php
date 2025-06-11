<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insert([
            ['prodi_kode' => 'TRPL', 'prodi_nama' => 'Teknologi Rekayasa Perangkat Lunak', 'jurusan_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'MI', 'prodi_nama' => 'Manajemen Informatika', 'jurusan_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // Tambahan prodi baru
            ['prodi_kode' => 'JTD', 'prodi_nama' => 'Jaringan Telekomunikasi Digital', 'jurusan_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'SK', 'prodi_nama' => 'Sistem Kelistrikan', 'jurusan_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'OK', 'prodi_nama' => 'Teknik Otomotif Elektronik', 'jurusan_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'MPP', 'prodi_nama' => 'Teknik Mesin Produksi Dan Perawatan', 'jurusan_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'AM', 'prodi_nama' => 'Akuntansi Manajemen', 'jurusan_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'KU', 'prodi_nama' => 'Keuangan', 'jurusan_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'MRK', 'prodi_nama' => 'Manajemen Rekayasa Konstruksi', 'jurusan_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'TKJ', 'prodi_nama' => 'Teknologi Rekayasa Konstruksi Jalan dan Jembatan', 'jurusan_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'TK', 'prodi_nama' => 'Teknik Kimia', 'jurusan_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['prodi_kode' => 'MP', 'prodi_nama' => 'Manajemen Pemasaran', 'jurusan_id' => 9, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}