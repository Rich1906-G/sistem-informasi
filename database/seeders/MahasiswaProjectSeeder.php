<?php

namespace Database\Seeders;

use App\Models\MahasiswaProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MahasiswaProject::create([
            'mahasiswa_id' => 1,
            'project_id' => 1,
        ]);

        MahasiswaProject::create([
            'mahasiswa_id' => 1,
            'project_id' => 2,
        ]);

        MahasiswaProject::create([
            'mahasiswa_id' => 2,
            'project_id' => 1,
        ]);

        MahasiswaProject::create([
            'mahasiswa_id' => 2,
            'project_id' => 2,
        ]);
    }
}
