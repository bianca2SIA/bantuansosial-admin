<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateVerifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $catatanList = [
            "Dokumen lengkap dan valid.",
            "Perlu pengecekan ulang kondisi rumah.",
            "Penghasilan perlu diverifikasi ulang.",
            "KTP tidak terbaca, mohon unggah ulang.",
            "Alamat tidak ditemukan saat kunjungan.",
            "Warga layak menerima bantuan.",
            "Data belum diverifikasi oleh RT.",
            "Butuh survei lapangan tambahan.",
        ];

        $pendaftarList = DB::table('pendaftar')->pluck('pendaftar_id');

        if ($pendaftarList->isEmpty()) {
            echo "Tabel pendaftar kosong. Isi dulu data pendaftar.\n";
            return;
        }

        foreach ($pendaftarList as $id) {
            DB::table('verifikasi')->insert([
                'pendaftar_id' => $id,
                'petugas'      => $faker->name(),
                'tanggal'      => $faker->date(),
                'catatan'      => $faker->boolean(60)
                    ? $faker->randomElement($catatanList)
                    : '-',
                'skor'         => $faker->numberBetween(10, 100),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
