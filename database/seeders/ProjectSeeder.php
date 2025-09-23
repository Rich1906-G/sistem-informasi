<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileName = "Final Presentation David Richardo Gultom.pdf";

        Project::create([
            'tugas_id' => 1,
            // 'mahasiswa_id' => 1,
            'nama_project' => 'CRUD Mahasiswa',
        ]);

        Project::create([
            'tugas_id' => 1,
            // 'mahasiswa_id' => 1,
            'nama_project' => 'Validasi Form',
        ]);

        Project::create([
            'tugas_id' => 2,
            // 'mahasiswa_id' => 1,
            'nama_project' => 'Desain UI POS',
        ]);

        Project::create([
            'tugas_id' => 2,
            // 'mahasiswa_id' => 1,
            'nama_project' => 'Fitur Transaksi POS',
        ]);

        // Project::create([
        //     'tugas_id' => 3,
        //     'mahasiswa_id' => 2,
        //     'nama_project' => 'CRUD Mahasiswa',
        // ]);

        // Project::create([
        //     'tugas_id' => 3,
        //     'mahasiswa_id' => 2,
        //     'nama_project' => 'Validasi Form',
        // ]);

        // Project::create([
        //     'tugas_id' => 4,
        //     'mahasiswa_id' => 2,
        //     'nama_project' => 'Desain UI POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 4,
        //     'mahasiswa_id' => 2,
        //     'nama_project' => 'Fitur Transaksi POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 5,
        //     'mahasiswa_id' => 3,
        //     'nama_project' => 'CRUD Mahasiswa',
        // ]);

        // Project::create([
        //     'tugas_id' => 5,
        //     'mahasiswa_id' => 3,
        //     'nama_project' => 'Validasi Form',
        // ]);

        // Project::create([
        //     'tugas_id' => 6,
        //     'mahasiswa_id' => 3,
        //     'nama_project' => 'Desain UI POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 6,
        //     'mahasiswa_id' => 3,
        //     'nama_project' => 'Fitur Transaksi POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 7,
        //     'mahasiswa_id' => 4,
        //     'nama_project' => 'CRUD Mahasiswa',
        // ]);

        // Project::create([
        //     'tugas_id' => 7,
        //     'mahasiswa_id' => 4,
        //     'nama_project' => 'Validasi Form',
        // ]);

        // Project::create([
        //     'tugas_id' => 8,
        //     'mahasiswa_id' => 4,
        //     'nama_project' => 'Desain UI POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 8,
        //     'mahasiswa_id' => 4,
        //     'nama_project' => 'Fitur Transaksi POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 9,
        //     'mahasiswa_id' => 5,
        //     'nama_project' => 'CRUD Mahasiswa',
        // ]);

        // Project::create([
        //     'tugas_id' => 9,
        //     'mahasiswa_id' => 5,
        //     'nama_project' => 'Validasi Form',
        // ]);

        // Project::create([
        //     'tugas_id' => 10,
        //     'mahasiswa_id' => 5,
        //     'nama_project' => 'Desain UI POS',
        // ]);

        // Project::create([
        //     'tugas_id' => 10,
        //     'mahasiswa_id' => 5,
        //     'nama_project' => 'Fitur Transaksi POS',
        // ]);
    }
}
