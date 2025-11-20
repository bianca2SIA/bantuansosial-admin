<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // User Admin Pertama
        User::updateOrCreate(
            ['email' => 'bianca24si@mahasiswa.pcr.ac.id'],
            [
                'name'              => 'Admin',
                'password'          => Hash::make('bianca'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        // 100 User Dummy
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name'              => $faker->name(),
                'email'             => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'remember_token'    => Str::random(10),
            ]);
        }
    }
}
