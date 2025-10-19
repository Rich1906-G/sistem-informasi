<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listRole = ['Admin', 'Dokter', 'Mahasiswa'];
        $faker = Faker::create('id_ID');

        Account::create([
            'username' => 'Admin',
            'password' => Hash::make('passwordAdmin'),
            'role' => 'Admin',
        ]);

        Account::create([
            'username' => 'Dokter',
            'password' => Hash::make('passwordDokter'),
            'role' => 'Dokter',
        ]);

        Account::create([
            'username' => 'David',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);

        foreach ($listRole as $role) {
            for ($i = 0; $i < 5; $i++) {
                Account::create(attributes: [
                    'username' => $faker->userName(),
                    'password' => Hash::make('password'),
                    'role' => $role,
                ]);
            }
        }
    }
}
