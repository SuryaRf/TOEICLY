<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh: pastikan jurusan dengan id 1 sudah ada
        DB::table('dosen')->insert([
            [
                'nidn' => '1234567890',
                'nik' => '3578012300010001',
                'nama' => 'Dr. Ahmad Rasyid',
                'jenis_kelamin' => 'Laki-laki',
                'jurusan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '0987654321',
                'nik' => '3578012300010002',
                'nama' => 'Prof. Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'jurusan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
