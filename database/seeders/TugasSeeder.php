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
            'nama_tugas' => 'Project 1',
            'file_tugas' => 'storage/tugas/' . $fileName,
            'status'  => 'Tidak Disetujui'
        ]);

        Tugas::create([
            'mahasiswa_id' => 1,
            'nama_tugas' => 'Project 2',
            'file_tugas' => 'storage/tugas/' . $fileName,
            'status'  => 'Disetujui'
        ]);
    }
}
