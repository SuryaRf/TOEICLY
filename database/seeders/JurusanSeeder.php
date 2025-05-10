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
        ]);
    }
}
