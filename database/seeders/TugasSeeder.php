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
            'admin_id' => 1,
            'nama_tugas' => 'Tugas Laravel',
        ]);

        Tugas::create([
            'admin_id' => 1,
            'nama_tugas' => 'Tugas Mobile',
        ]);
    }
}
