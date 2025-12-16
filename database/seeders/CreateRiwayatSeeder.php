<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRiwayatSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $programList  = DB::table('program')->pluck('program_id')->toArray();
        $penerimaList = DB::table('penerima')->pluck('penerima_id')->toArray();

        if (empty($programList) || empty($penerimaList)) {
            echo "Program atau Penerima masih kosong. Seeder dihentikan.\n";
            return;
        }

        foreach ($penerimaList as $penerima_id) {

            // Setiap penerima bisa punya 1–3 tahap penyaluran
            $jumlahTahap = rand(1, 3);

            for ($tahap = 1; $tahap <= $jumlahTahap; $tahap++) {

                // ⬅️ INI KUNCI UTAMA
                $tanggal = $faker->dateTimeBetween('-8 months', 'now');

                DB::table('riwayat')->insert([
                    'program_id'       => $faker->randomElement($programList),
                    'penerima_id'      => $penerima_id,
                    'tahap_ke'         => $tahap,
                    'tanggal'          => $tanggal,
                    'nilai'            => $faker->numberBetween(500000, 5000000),
                    'bukti_penyaluran' => $faker->boolean(60)
                        ? 'bukti_' . $faker->uuid . '.jpg'
                        : null,
                    'created_at'       => $tanggal,
                    'updated_at'       => $tanggal,
                ]);
            }
        }
    }
}
