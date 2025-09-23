<?php

namespace Database\Seeders;

use App\Models\MahasiswaTugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MahasiswaTugas::create([
            'mahasiswa_id' => 1,
            'tugas_id' => 1,
        ]);

        MahasiswaTugas::create([
            'mahasiswa_id' => 1,
            'tugas_id' => 2,
        ]);

        MahasiswaTugas::create([
            'mahasiswa_id' => 2,
            'tugas_id' => 1,
        ]);

        MahasiswaTugas::create([
            'mahasiswa_id' => 2,
            'tugas_id' => 2,
        ]);
    }
}
