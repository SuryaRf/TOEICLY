<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItcSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('itc')->insert([
            [
                'nama' => 'Pak Slamet',
                'email' => 'slamet.itc@example.com',
                'telepon' => '081234567895',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bu Rina',
                'email' => 'rina.itc@example.com',
                'telepon' => '081234567896',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
