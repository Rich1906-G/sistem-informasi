<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Project;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiController extends Controller
{
    public function dashboard()
    {
        return view('prodi.dashboard', ['title' => 'Dashboard Prodi', 'header' => 'Dashboard Prodi']);
    }

    public function tugasMahasiswa()
    {
        $account_id = Auth::guard('account')->id();

        // Ambil prodi yang terkait dengan account login
        $prodi = Prodi::where('account_id', $account_id)->firstOrFail();

        // Ambil semua tugas dan mahasiswa yang terkait prodi ini
        $tugas = Tugas::where('prodi_id', $prodi->id)->pluck('id'); // ambil hanya id tugas
        // $mahasiswa = Mahasiswa::where('prodi_id', $prodi->id)->pluck('id'); // ambil hanya id mahasiswa

        // $data_tugas = Tugas::with('project', 'mahasiswa')->paginate(10);

        // $data_tugas = Mahasiswa::with('project', 'tugas')->paginate(10);

        // Ambil semua tugas dari prodi ini beserta mahasiswa yang mengerjakan
        $data_tugas = Tugas::with('mahasiswa', 'project')
            ->where('prodi_id', $prodi->id)
            ->paginate(10);

        return view('prodi.tugas', [
            'data_tugas' => $data_tugas,
            'prodi'      => $prodi,
            'title'      => 'Tugas Mahasiswa',
            'header'     => 'Tugas Mahasiswa',
        ]);
    }

    public function tambahTugasMahasiswa(Request $request, $idProdi)
    {
        $request->validate([
            'nama_tugas' => ['required'],
        ]);

        Tugas::create([
            'prodi_id' => $idProdi,
            'nama_tugas' => $request->nama_tugas,
        ]);

        return redirect()->back();
    }

    public function projectMahasiswa()
    {
        $data_project = Project::with('tugas', 'mahasiswa')->paginate(10);
        $data_tugas   = Tugas::all(); // atau filter sesuai prodi / kebutuhan

        return view('prodi.project', compact('data_project', 'data_tugas'), ['title' => 'Project Mahasiswa', 'header' => 'Project Mahasiswa']);
    }

    public function tambahProjectMahasiswa(Request $request)
    {
        $request->validate([
            'tugas_id' => ['required'],
            'nama_project' => ['required'],
        ]);

        Project::create([
            'tugas_id' => $request->tugas_id,
            'nama_project' => $request->nama_project,
        ]);

        return redirect()->back();
    }

    public function setujui_tugas($tugas_id, $mahasiswa_id)
    {
        $tugas = Tugas::findOrFail($tugas_id);

        // Update status di pivot
        $tugas->mahasiswa()->updateExistingPivot($mahasiswa_id, [
            'status' => 'Disetujui'
        ]);

        return redirect()->back();
    }

    public function tolak_tugas($tugas_id, $mahasiswa_id)
    {
        $tugas = Tugas::findOrFail($tugas_id);

        // Update status di pivot
        $tugas->mahasiswa()->updateExistingPivot($mahasiswa_id, [
            'status' => 'Tidak Disetujui'
        ]);

        return redirect()->back();
    }
}
