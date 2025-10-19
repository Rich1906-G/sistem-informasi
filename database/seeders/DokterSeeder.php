<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $roleDokter = Account::where('role', 'Dokter')->get();

        foreach ($roleDokter as $role) {

            Dokter::create([
                'account_id' => $role->id,
                'nama_dokter' => $faker->name(),
                'email_dokter' => $faker->unique()->safeEmail(),
                'no_hp_dokter' => $faker->phoneNumber(),
            ]);
        }
    }
}
