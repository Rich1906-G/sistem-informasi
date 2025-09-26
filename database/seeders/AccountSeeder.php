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
            'username' => 'David',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);

        Account::create(attributes: [
            'username' => 'Adrian',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);

        Account::create([
            'username' => 'Jonathan',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);

        Account::create([
            'username' => 'Stephan',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);

        Account::create([
            'username' => 'Anderson',
            'password' => Hash::make('passwordMahasiswa'),
            'role' => 'Mahasiswa',
        ]);
    }
}
