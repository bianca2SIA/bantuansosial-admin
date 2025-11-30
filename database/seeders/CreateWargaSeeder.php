<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateWargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {

            DB::table('warga')->insert([
                'no_ktp'        => $faker->unique()->nik(), 
                'nama'          => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->randomElement([
                    'Petani', 'Guru', 'Mahasiswa', 'Pedagang', 'Nelayan',
                    'Karyawan Swasta', 'Ibu Rumah Tangga', 'Wiraswasta',
                ]),
                'telp'          => $faker->phoneNumber(),
                'email'         => strtolower(
                    str_replace(' ', '', $faker->unique()->name()) . '@gmail.com'
                ),

                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
