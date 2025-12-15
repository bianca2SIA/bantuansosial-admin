<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePenerimaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $programList = DB::table('program')->pluck('program_id')->toArray();
        $wargaList   = DB::table('warga')->pluck('warga_id')->toArray();

        if (empty($programList) || empty($wargaList)) {
            echo "Tabel program atau warga kosong. Seeder dihentikan.\n";
            return;
        }

        for ($i = 0; $i < 100; $i++) {
            DB::table('penerima')->insert([
                'program_id' => $faker->randomElement($programList),
                'warga_id'   => $faker->randomElement($wargaList),
                'keterangan' => $faker->boolean(70)
                    ? $faker->randomElement([
                    'Layak menerima bantuan',
                    'Butuh verifikasi tambahan',
                    'Data sesuai hasil survei',
                    'Terverifikasi oleh petugas',
                    'Dalam pemantauan lanjutan',
                    'Disalurkan bulan ini',
                ])
                    : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
