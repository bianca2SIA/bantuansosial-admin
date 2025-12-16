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
            ['email' => 'super@gmail.com'],
            [
                'name'              => 'Super Admin',
                'password'          => Hash::make('biancabahi'),
                'role'              => 'Super Admin',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'              => 'Admin Bansos',
                'password'          => Hash::make('biancabahi'),
                'role'              => 'Admin Bansos',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name'              => 'Petugas Lapangan',
                'password'          => Hash::make('biancabahi'),
                'role'              => 'Petugas Lapangan',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name'  => $faker->name(),
                'email' => strtolower(
                    str_replace('.', '', $faker->unique()->userName)
                ) . '@gmail.com',
                'role'  => $faker->randomElement([
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
