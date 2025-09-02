<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            'account_id' => 2,
            'nama_prodi' => 'Teknik Informatika',
            'nama_kaprodi' => 'Agung Prabowo S.Kom, M.kom.,',
        ]);
    }
}
