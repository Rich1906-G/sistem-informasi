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
            'nim' => '223303030307',
            'semester' => '7',
            'no_hp' => '082268742976',
            'pas_foto' => 'storage/foto/' . $fileName,
            'nama_pas_foto' => $fileName,
        ]);
    }
}
