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
                'email' => 'budi.hartono@example.com',
                'telepon' => '081234567893',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198802022015041002',
                'nama' => 'Yuli Andriani',
                'email' => 'yuli.andriani@example.com',
                'telepon' => '081234567894',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
