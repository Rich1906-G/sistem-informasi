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
        $nama_pas_foto_david = 'Pas_Foto_Mahasiswa.jpg';
        $nama_pas_foto_adrian = 'Pas_Foto_Adrian.jpg';

        // Storage::disk('public')->put('foto', $fileName, 'content dummy');


        Mahasiswa::create([
            'account_id' => 3,
            'nama_mahasiswa' => 'David Richardo Gultom',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'email' => 'DavidgultomM@gmail.com',
            'alamat' => 'Jln. Kertas No 15A',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $nama_pas_foto_david,
            'nama_pas_foto' => $nama_pas_foto_david,
        ]);

        Mahasiswa::create([
            'account_id' => 4,
            'nama_mahasiswa' => 'Adrian Hutabarat',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'email' => 'adrianhutabarat13@gmail.com',
            'alamat' => 'Jalan Adiankoting',
            'no_hp' => '085258221329',
            'pas_foto' => 'storage/' . $nama_pas_foto_adrian,
            'nama_pas_foto' => $nama_pas_foto_adrian,
        ]);

        Mahasiswa::create([
            'account_id' => 5,
            'nama_mahasiswa' => 'Jonathan Purba',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'email' => 'nathanpb@gmail.com',
            'alamat' => 'Jln. Kuali No 64',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $nama_pas_foto_david,
            'nama_pas_foto' => $nama_pas_foto_david,
        ]);

        Mahasiswa::create([
            'account_id' => 6,
            'nama_mahasiswa' => 'Stephan Panggabean',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'email' => 'StephanimmanuelM@gmail.com',
            'alamat' => 'Jln. Sendok No 87',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $nama_pas_foto_david,
            'nama_pas_foto' => $nama_pas_foto_david,
        ]);
        Mahasiswa::create([
            'account_id' => 7,
            'nama_mahasiswa' => 'Anderson Nababan',
            'nim' => fake()->unique()->numberBetween(1000, 9999),
            'semester' => '7',
            'email' => 'AndersonNbb@gmail.com',
            'alamat' => 'Jln. Kertas No 115',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/' . $nama_pas_foto_david,
            'nama_pas_foto' => $nama_pas_foto_david,
        ]);
    }
}
