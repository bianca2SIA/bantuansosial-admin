<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePendaftarSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID yang benar-benar ada di tabel program dan warga
        $programIds = DB::table('program')->pluck('program_id')->toArray();
        $wargaIds   = DB::table('warga')->pluck('warga_id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            DB::table('pendaftar')->insert([
                'program_id'     => $faker->randomElement($programIds),
                'warga_id'       => $faker->randomElement($wargaIds),
                'status_seleksi' => $faker->randomElement(['Menunggu', 'Diterima', 'Ditolak']),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
