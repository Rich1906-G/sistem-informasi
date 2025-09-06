<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Project;
use App\Models\Tugas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', ['title' => 'Dashboard Admin', 'header' => 'Dashboard Admin']);
    }

    public function mahasiswa()
    {
        $data_mahasiswa = Mahasiswa::paginate(10);
        // dd($data_mahasiswa);
        return view('admin.mahasiswa', compact('data_mahasiswa'), ['title' => 'Data Mahasiswa', 'header' => 'Data Mahasiswa']);
    }

    public function tugas()
    {
        $data_tugas = Tugas::with('mahasiswa', 'project')->paginate(10);
        return view('admin.tugas', compact('data_tugas'), ['title' => 'Tugas Mahasiswa', 'header' => 'Tugas Mahasiswa']);
    }

    public function setujui_tugas($id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->status === 'Disetujui') {
            $tugas->update(['status' => 'Tidak Disetujui']);
        } elseif ($tugas->status === 'Tidak Disetujui') {
            $tugas->update([
                'status' => 'Disetujui'
            ]);
        }

        return redirect()->back();
    }

    public function cari_data_mahasiswa(Request $request)
    {
        $cari = $request->input('search');

        if (is_null($cari) || empty($cari)) {
            return redirect()->back();
        }

        $data_mahasiswa = Mahasiswa::where('nama_mahasiswa', 'like', '%' . $cari . '%')
            ->orWhere('nim', 'like', '%' . $cari . '%')->paginate()->withQueryString();

        if ($data_mahasiswa->isEmpty()) {
            return redirect()->back();
        }

        // dd($data_mahasiswa);
        return view('admin.mahasiswa', compact('data_mahasiswa'), ['title' => 'Data Mahasiswa', 'header' => 'Data Mahasiswa']);
    }
}
