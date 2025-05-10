<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '2241720001',
                'nama' => 'Budi Santoso',
                'nik' => '3507120200010001',
                'alamat_asal' => 'Jombang',
                'alamat_sekarang' => 'Malang',
                'angkatan' => '2022',
                'no_telp' => '081212121212',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'aktif',
                'keterangan' => 'gratis',
                'prodi_id' => 1
            ],
        ]);
    }
}
