<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

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

    public function tugas()
    {
        $account = Auth::guard('account')->id();

        $mahasiswa = Mahasiswa::where('account_id', $account)->first();

        $data_tugas = Tugas::with('mahasiswa', 'project')->where('mahasiswa_id', $mahasiswa->id)->paginate(10);

        // dd($data_tugas);

        return view('mahasiswa.tugas', compact('data_tugas'), ['title' => 'Data Tugas', 'header' => 'Data Tugas']);
    }
}
