<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua pendaftaran_id dari tabel pendaftaran
        $pendaftaranIds = DB::table('pendaftaran')->pluck('pendaftaran_id');

        foreach ($pendaftaranIds as $id) {
            DB::table('detail_pendaftaran')->insert([
                'pendaftaran_id' => $id,
                'status' => collect(['menunggu', 'diterima', 'ditolak'])->random(),
                'catatan' => fake()->optional()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
