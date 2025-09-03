<?php

namespace Database\Seeders;

use App\Models\Tugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileName = "Final Presentation David Richardo Gultom.pptx";

        Tugas::create([
            'mahasiswa_id' => 1,
            'nama_tugas' => 'Tugas Laravel',
            'status'  => 'Tidak Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 1,
            'nama_tugas' => 'Tugas Mobile',
            'status'  => 'Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 2,
            'nama_tugas' => 'Tugas Laravel',
            'status'  => 'Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 2,
            'nama_tugas' => 'Tugas Mobile',
            'status'  => 'Tidak Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 3,
            'nama_tugas' => 'Tugas Laravel',
            'status'  => 'Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 3,
            'nama_tugas' => 'Tugas Mobile',
            'status'  => 'Tidak Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 4,
            'nama_tugas' => 'Tugas Laravel',
            'status'  => 'Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 4,
            'nama_tugas' => 'Tugas Mobile',
            'status'  => 'Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 5,
            'nama_tugas' => 'Tugas Laravel',
            'status'  => 'Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 5,
            'nama_tugas' => 'Tugas Mobile',
            'status'  => 'Disetujui'
        ]);
    }
}
