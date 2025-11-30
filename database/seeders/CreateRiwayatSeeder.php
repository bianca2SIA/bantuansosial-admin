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

        $programList  = DB::table('program')->pluck('program_id');
        $penerimaList = DB::table('penerima')->pluck('penerima_id');

        if ($programList->isEmpty() || $penerimaList->isEmpty()) {
            echo "Program atau Penerima masih kosong. Seeder dihentikan.\n";
            return;
        }

        foreach ($penerimaList as $penerima_id) {

            DB::table('riwayat')->insert([
                'program_id'       => $faker->randomElement($programList),
                'penerima_id'      => $penerima_id,
                'tahap_ke'         => $faker->numberBetween(1, 3),
                'tanggal'          => $faker->date(),
                'nilai'            => $faker->numberBetween(100000, 2000000),
                'bukti_penyaluran' => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        echo "Seeder Riwayat selesai.\n";
    }
}
