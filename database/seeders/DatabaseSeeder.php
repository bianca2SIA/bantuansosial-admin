<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
// Tambahkan ini untuk men-seed semua tabel lainnya
        $this->call([
            CreateWargaSeeder::class,
            CreateFirstUser::class,
            CreateProgramSeeder::class,
            CreatePendaftarSeeder::class, // relasi proyek → lokasi
        ]);
    }
}
