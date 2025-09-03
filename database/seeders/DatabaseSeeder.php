<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountSeeder::class,
            AdminSeeder::class,
            ProdiSeeder::class,
            MahasiswaSeeder::class,
            TugasSeeder::class,
            ProjectSeeder::class,
        ]); 
    }
}
