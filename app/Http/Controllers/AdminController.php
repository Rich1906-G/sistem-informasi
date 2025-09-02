<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', ['title' => 'Dashboard Admin']);
    }

    public function mahasiswa()
    {
        $data_mahasiswa = Mahasiswa::paginate(10);
        // dd($data_mahasiswa);
        return view('admin.mahasiswa', compact('data_mahasiswa'), ['title' => 'Data Mahasiswa', 'header' => 'Data Mahasiswa']);
    }

    public function tugas()
    {
        // $data_mahasiswa = Mahasiswa::all();
        // dd($data_mahasiswa);
        return view('admin.tugas', ['title' => 'Tugas Mahasiswa', 'header' => 'Tugas Mahasiswa']);
    }
}
