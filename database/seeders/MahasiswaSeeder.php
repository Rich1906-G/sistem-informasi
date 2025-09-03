<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileName = 'Pas_Foto_Mahasiswa.jpg';

        // Storage::disk('public')->put('foto', $fileName, 'content dummy');


        Mahasiswa::create([
            'account_id' => 3,
            'nama_mahasiswa' => 'David Richardo Gultom',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $fileName,
            'nama_pas_foto' => $fileName,
        ]);

        Mahasiswa::create([
            'account_id' => 4,
            'nama_mahasiswa' => 'Adrian Hutabarat',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $fileName,
            'nama_pas_foto' => $fileName,
        ]);

        Mahasiswa::create([
            'account_id' => 5,
            'nama_mahasiswa' => 'Jonathan Purba',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $fileName,
            'nama_pas_foto' => $fileName,
        ]);

        Mahasiswa::create([
            'account_id' => 6,
            'nama_mahasiswa' => 'Stephan Panggabean',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $fileName,
            'nama_pas_foto' => $fileName,
        ]);
        Mahasiswa::create([
            'account_id' => 7,
            'nama_mahasiswa' => 'Anderson Nababan',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $fileName,
            'nama_pas_foto' => $fileName,
        ]);



        // Mahasiswa::create([
        //     'account_id' => 8,
        //     'nama_mahasiswa' => 'David Richardo Gultom',
        //     'nim' => fake()->unique()->numberBetween(1000, 9999),
        //     'semester' => '7',
        //     'no_hp' => '082268742976',
        //     'pas_foto' => 'storage/' . $fileName,
        //     'nama_pas_foto' => $fileName,
        // ]);
    }
}
