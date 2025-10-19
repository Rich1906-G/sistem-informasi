<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DokterController extends Controller
{
    public function dashboard()
    {
        return view('dokter.dasboard', ['title' => 'Dashboard Dokter', 'header' => 'Dashboard Dokter']);
    }

    public function tugas()
    {
        $idAkun = Auth::guard('account')->id();

        $dokter = Dokter::where('account_id', $idAkun)->firstOrFail();

        $data_tugas = Tugas::paginate(10);

        return view('dokter.tugas', compact('data_tugas', 'dokter'), ['title' => 'Data Tugas', 'header' => 'Data Tugas']);
    }

    public function createTugas(Request $request, $id)
    {
        $request->validate([
            'nama_tugas' => ['required'],
        ]);

        Tugas::create([
            'dokter_id' => $id,
            'nama_tugas' => $request->nama_tugas,
        ]);

        return redirect()->back();
    }

    public function updateTugas(Request $request, $id)
    {
        $request->validate([
            'nama_tugas' => ['required'],
            'tugas_id' => ['required', 'exists:tugas,id'],
        ]);

        $tugas = Tugas::findOrFail($request->tugas_id);

        $tugas->update([
            'dokter_id' => $id,
            'nama_tugas' => $request->nama_tugas,
            'slug' =>  Str::slug($request->nama_tugas, '-'),
        ]);

        return redirect()->back();
    }

    public function deleteTugas($id)
    {
        $dataTugas = Tugas::findOrFail($id);

        $dataTugas->delete();

        return redirect()->back();
    }

    public function tugasMahasiswa()
    {
        $idAkun = Auth::guard('account')->id();

        $dokter = Dokter::where('account_id', $idAkun)->firstOrFail();

        $dataTugas = Tugas::with('mahasiswa')->paginate(10);

        return view('dokter.tugas-mahasiswa', compact('dokter', 'dataTugas'), ['title' => 'Tugas Mahasiswa', 'header' => 'Tugas Mahasiswa']);
    }

    public function project($slug)
    {
        $data_tugas = Tugas::with('project')->where('slug', $slug)->firstOrFail();

        $data_project = $data_tugas->project()->paginate(10);

        return view('dokter.project', compact('data_tugas', 'data_project'), ['title' => 'Detail Project']);
    }
}
