<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataAkun = Account::where('role', 'Admin')->get();
        $faker = Faker::create('id_ID');

        foreach ($dataAkun as $akun) {
            for ($i = 0; $i < 5; $i++) {
                Admin::create([
                    'account_id' => $akun->id,
                    'nama' => $faker->name(),
                    'email' => $faker->unique()->safeEmail,
                    'no_hp' => $faker->phoneNumber(),
                ]);
            }
        }
    }
}
