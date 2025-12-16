<?php
namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        User::updateOrCreate(
            ['email' => 'bianca24si@mahasiswa.pcr.ac.id'],
            [
                'name'              => 'Admin',
                'password'          => Hash::make('bianca'),
                'role'              => 'Super Admin',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name'              => $faker->name(),
                'email' => $faker->unique()->userName . '@gmail.com',
                'role'              => $faker->randomElement([
                    'Admin Bansos',
                    'Petugas Lapangan',
                ]),
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'remember_token'    => Str::random(10),
            ]);
        }

    }
}
