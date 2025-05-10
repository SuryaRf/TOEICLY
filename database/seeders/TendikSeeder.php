<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TendikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tendik')->insert([
            [
                'nip' => '198701012014031001',
                'nama' => 'Budi Hartono',
                'no_telp' => '081234567893',
                'jenis_kelamin' => 'Laki-laki',
                'kampus_id' => 1, // pastikan kampus dengan ID 1 sudah ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198802022015041002',
                'nama' => 'Yuli Andriani',
                'no_telp' => '081234567894',
                'jenis_kelamin' => 'Perempuan',
                'kampus_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
