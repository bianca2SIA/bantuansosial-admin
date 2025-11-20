<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateProgramSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $namaProgram = [
            'Bantuan Pendidikan',
            'Renovasi Rumah Tidak Layak Huni',
            'Bantuan UMKM',
            'Bantuan Kesehatan',
            'Pembangunan Jalan Desa',
            'Bantuan Sembako',
            'Pengembangan Pertanian',
            'Beasiswa Prestasi',
            'Bantuan Lansia',
            'Perbaikan Infrastruktur Desa',
        ];

        $deskripsiIndo = [
            'Program ini bertujuan untuk meningkatkan kesejahteraan masyarakat.',
            'Bantuan diberikan kepada warga yang membutuhkan.',
            'Program dilaksanakan bekerja sama dengan pemerintah desa.',
            'Dana digunakan untuk mendukung kegiatan sosial masyarakat.',
            'Kegiatan ini bertujuan untuk memperbaiki fasilitas umum.',
            'Program membantu warga dalam memenuhi kebutuhan dasar.',
            'Kegiatan difokuskan pada peningkatan sarana prasarana desa.',
            'Program ini mendukung pengembangan ekonomi masyarakat.',
            'Kegiatan dilakukan secara bertahap sesuai jadwal pelaksanaan.',
            'Tujuan utama program ini adalah pemerataan pembangunan desa.',
        ];

        for ($i = 1; $i <= 100; $i++) {
            DB::table('program')->insert([
                'kode'         => 'PRG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_program' => $faker->randomElement($namaProgram),
                'tahun'        => $faker->numberBetween(2020, 2026),

                'deskripsi'    => $faker->randomElement($deskripsiIndo),
                'anggaran'     => $faker->numberBetween(50000000, 2000000000),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
