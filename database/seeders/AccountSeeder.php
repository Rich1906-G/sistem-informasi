<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'username' => 'admin',
            'password' => Hash::make('passwordAdmin'),
            'role' => 'Admin',
        ]);

        Account::create([
            'username' => 'prodi',
            'password' => Hash::make('passwordProdi'),
            'role' => 'Prodi',
        ]);

        Account::create([
            'username' => 'mahasiswa',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);
    }
}
