<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $account = Auth::guard('account')->id();

        $data_mahasiswa = Mahasiswa::where('account_id', $account)->first();

        // dd($data_mahasiswa);

        return view('mahasiswa.dashboard', compact('data_mahasiswa'), ['title' => 'Dashboard Mahasiswa', 'header' => 'Dashboard Mahasiswa']);
    }

    public function mahasiswa()
    {
        $account = Auth::guard('account')->id();

        $data_mahasiswa = Mahasiswa::where('account_id', $account)->first();

        // dd($data_mahasiswa);

        return view('mahasiswa.mahasiswa', compact('data_mahasiswa'), ['title' => 'Data Mahasiswa', 'header' => 'Data Mahasiswa']);
    }
}
