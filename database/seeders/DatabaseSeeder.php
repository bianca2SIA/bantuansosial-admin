<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CreateWargaSeeder::class,
            CreateFirstUser::class,
            CreateProgramSeeder::class,
            CreatePendaftarSeeder::class,
            CreateVerifikasiSeeder::class,
            CreatePenerimaSeeder::class,
            CreateRiwayatSeeder::class,
        ]);
    }
}
