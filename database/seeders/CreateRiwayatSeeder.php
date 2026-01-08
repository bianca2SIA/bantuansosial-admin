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

            DB::table('riwayat')->insert([
                'program_id'  => $faker->randomElement($programList),
                'penerima_id' => $penerima_id,
                'tahap_ke'    => 1,
                'tanggal'     => now(),
                'nilai'       => $faker->numberBetween(500000, 5000000),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
