<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nama_pas_foto_david = 'Pas_Foto_Mahasiswa.jpg';
        $nama_pas_foto_adrian = 'Pas_Foto_Adrian.jpg';

        // Storage::disk('public')->put('foto', $fileName, 'content dummy');

        $faker = Faker::create('id_ID');

        $roleMahasiswa = Account::where('role', 'Mahasiswa')->get();

        foreach ($roleMahasiswa as $mahasiswa) {
            $nama = $faker->name();
            Mahasiswa::create([
                'account_id' => $mahasiswa->id,
                'nama_mahasiswa' => $nama,
                'slug' => Str::slug($nama),
                'nim' => $faker->numberBetween(100000000000, 999999999999),
                'semester' => $faker->randomDigit(),
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber(),
                'pas_foto' => 'storage/' . $nama_pas_foto_david,
                'nama_pas_foto' => $nama_pas_foto_david,
            ]);
        }
    }
}
