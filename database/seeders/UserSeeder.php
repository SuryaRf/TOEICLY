<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'profile' => null,
                'role' => 'admin',
                'admin_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'mahasiswa@example.com',
                'username' => 'mahasiswa',
                'password' => Hash::make('password'),
                'profile' => null,
                'role' => 'mahasiswa',
                'mahasiswa_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
