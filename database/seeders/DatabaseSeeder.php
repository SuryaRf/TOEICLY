<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DosenSeeder::class,
            JurusanSeeder::class,
            ProdiSeeder::class,
            MahasiswaSeeder::class,
            TendikSeeder::class,
            ItcSeeder::class,
            UserSeeder::class,
            JadwalSeeder::class,
            PendaftaranSeeder::class,
            UjianSeeder::class,
            HasilUjianSeeder::class,
            DetailPendaftaranSeeder::class,
            InformasiSeeder::class,
        ]);
    }
    
}
