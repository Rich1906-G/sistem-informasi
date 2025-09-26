<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'account_id' => 1,
            'nama' => 'David Richardo Gultom',
            'email' => 'davidgultomm@gmail.com',
            'no_hp' => '082268742976',  
        ]);
    }
}
