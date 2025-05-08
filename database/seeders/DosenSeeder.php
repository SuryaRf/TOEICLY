<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dosen')->insert([
            [
                'nidn' => '1234567890',
                'nama' => 'Dr. Ahmad Rasyid',
                'email' => 'ahmad.rasyid@example.com',
                'telepon' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '0987654321',
                'nama' => 'Prof. Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'telepon' => '081234567892',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
