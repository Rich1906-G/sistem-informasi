<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Project;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $dataTugas = Tugas::with('project')->paginate(10);

        return view('mahasiswa.tugas', compact('dataTugas'), ['title' => 'Data Tugas', 'header' => 'Data Tugas']);
    }

    public function project($slug)
    {
        $slugTugas = Tugas::where('slug', $slug)->firstOrFail();

        // Ambil mahasiswa yang login (jangan pakai id langsung kalau pakai guard custom)
        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->first(); // bisa null kalau belum lengkap

        $dataProject = Project::where('tugas_id', $slugTugas->id)
            ->with(['mahasiswa' => function ($q) use ($mahasiswa) {
                if ($mahasiswa) {
                    // pastikan nama tabel/kolom sesuai; 'mahasiswa.id' biasanya aman
                    $q->where('mahasiswa.id', $mahasiswa->id);
                }
            }])
            ->paginate(10);

        // $dataProject = $project->mahasiswa()->paginate(10);

        // dd($dataProject);

        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->first();

        // $dataProject = $dataTugas->project()
        //     ->whereHas('mahasiswa', function ($q) use ($mahasiswa) {
        //         $q->where('mahasiswa_id', $mahasiswa->id); // asumsi pakai auth()->id()
        //     })
        //     ->paginate(10);

        return view('mahasiswa.project', compact('slugTugas', 'dataProject'), ['title' => 'Detail Project']);
    }

    public function uploadProject(Request $request)
    {
        $request->validate([
            'project_id' => ['required', 'exists:project,id'],
            'file_project' => ['required', 'mimes:pdf'],
        ]);

        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->firstOrFail();

        $project = Project::findOrFail($request->project_id);
        $tugasId = $project->tugas_id; // ambil langsung dari relasi project

        $jalur = null;
        if ($request->hasFile('file_project')) {
            $file = $request->file('file_project');
            $jalur = $file->store('Tugas-Mahasiswa', 'public');

            $project->update([
                'status' => 'Sudah Submit'
            ]);
        } else {
            $project->update([
                'status' => 'Belum Submit'
            ]);
        }

        // Simpan ke pivot mahasiswa_project
        $mahasiswa->project()->syncWithoutDetaching([
            $project->id => [
                'file_project' => $jalur,
            ]
        ]);

        // Simpan ke pivot mahasiswa_tugas
        $mahasiswa->tugas()->syncWithoutDetaching([$tugasId]);

        return redirect()->back()->with('success', 'Project berhasil diupload!');
    }


    public function updateProject(Request $request)
    {
        $project = Project::findOrFail($request->project_id);

        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->firstOrFail();

        $request->validate([
            'project_id' => ['required', 'exists:project,id'],
            'file_project' => ['nullable', 'mimes:pdf'],
        ]);

        if ($request->hasFile('file_project')) {
            if ($project->file_project && Storage::disk('public')->exists($project->file_project)) {
                Storage::disk('public')->delete($project->file_project);
            }

            $file = $request->file('file_project');
            $jalur = $file->store('Tugas-Mahasiswa', 'public');

            $project->update([
                'file_project' => $jalur,
            ]);
        } else {
            // Kalau tidak upload file baru, tetap update status
            $project->update([
                'file_project' => '',
                'status' => 'Belum Submit'
            ]);
        }

        $mahasiswa->project()->attach($project->id);

        return redirect()->back();
    }

    public function deleteProject(Request $request) {}
}
