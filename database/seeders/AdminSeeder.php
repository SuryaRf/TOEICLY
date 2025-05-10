<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'nama' => 'Admin Utama',
                'no_telp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),


            ],
        ]);
    }
}
