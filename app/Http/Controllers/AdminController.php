<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Project;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $idAkun = Auth::guard('account')->id();

        $admin = Admin::where('account_id', $idAkun)->firstOrFail();

        $data_tugas = Tugas::paginate(10);

        return view('admin.tugas', compact('data_tugas', 'admin'), ['title' => 'Data Tugas', 'header' => 'Data Tugas']);
    }

    public function createTugas(Request $request, $id)
    {
        $request->validate([
            'nama_tugas' => ['required'],
        ]);

        Tugas::create([
            'admin_id' => $id,
            'nama_tugas' => $request->nama_tugas,
        ]);

        return redirect()->back();
    }

    public function updateTugas(Request $request)
    {
        $request->validate([
            'admin_id' => ['required', 'exists:admin,id'],
            'nama_tugas' => ['required'],
            'tugas_id' => ['required', 'exists:tugas,id'],
        ]);

        $tugas = Tugas::findOrFail($request->tugas_id);

        $tugas->update([
            'admin_id' => $request->admin_id,
            'nama_tugas' => $request->nama_tugas,
        ]);

        return redirect()->back();
    }

    public function deleteTugas(Request $request)
    {
        $tugas = Tugas::findOrFail($request->id);

        $tugas->delete();

        return redirect()->back();
    }

    public function tugasMahasiswa()
    {
        $idAkun = Auth::guard('account')->id();

        $admin = Admin::where('account_id', $idAkun)->firstOrFail();

        $dataTugas = Tugas::with('mahasiswa')->paginate(10);

        return view('admin.tugas-mahasiswa', compact('admin', 'dataTugas'), ['title' => 'Tugas Mahasiswa', 'header' => 'Tugas Mahasiswa']);
    }

    public function project($slug)
    {
        $data_tugas = Tugas::with('project')->where('slug', $slug)->firstOrFail();

        $data_project = $data_tugas->project()->paginate(10);

        return view('admin.project', compact('data_tugas', 'data_project'), ['title' => 'Detail Project']);
    }

    public function tambahProject(Request $request)
    {
        $request->validate([
            'tugas_id' => ['required', 'exists:tugas,id'],
            'nama_project' => ['required'],
        ]);

        Project::create([
            'tugas_id' => $request->tugas_id,
            'nama_project' => $request->nama_project,
        ]);

        return redirect()->back();
    }

    public function editProject(Request $request)
    {
        $project = Project::findOrFail($request->id);

        $request->validate([
            'nama_project' => ['required'],
        ]);

        $project->update([
            'nama_project' => $request->nama_project,
        ]);

        return redirect()->back();
    }

    public function deleteProject(Request $request)
    {
        $project = Project::findOrFail($request->id);

        $project->delete();

        return redirect()->back();
    }

    public function projectMahasiswa($slug)
    {
        $tugas = Tugas::where('slug', $slug)->with('mahasiswa')->firstOrFail();

        $dataMahasiswa = Mahasiswa::whereHas('tugas', function ($q) use ($tugas) {
            $q->where('tugas_id', $tugas->id);
        })->with(
            [
                'project' => function ($q) use ($tugas) {
                    $q->where('tugas_id', $tugas->id);
                },
                'tugas' => function ($q) use ($tugas) {
                    $q->where('tugas_id', $tugas->id);
                }
            ]
        )->paginate(10);

        $mahasiswaId = $dataMahasiswa->pluck('id');

        return view('admin.project-mahasiswa', compact('dataMahasiswa', 'tugas', 'mahasiswaId'), ['tugasId' => $tugas->id, 'title' => 'Project Mahasiswa']);
    }

    public function setujui_tugas(Request $request)
    {
        $tugas = Tugas::findOrFail($request->tugas_id);
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);

        $tugas->mahasiswa()->updateExistingPivot($mahasiswa->id, [
            'status' => 'Disetujui',
        ]);

        return redirect()->back();
    }

    public function tolakTugas(Request $request)
    {
        $tugas = Tugas::findOrFail($request->tugas_id);
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);

        $tugas->mahasiswa()->updateExistingPivot($mahasiswa->id, [
            'status' => 'Tidak Disetujui',
        ]);

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
