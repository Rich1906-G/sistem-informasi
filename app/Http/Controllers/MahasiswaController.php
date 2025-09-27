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
        $dataTugas = Tugas::with('project')->where('slug', $slug)->firstOrFail();

        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->firstOrFail();

        $dataProject = $dataTugas->project()
            ->whereHas('mahasiswa', function ($query) use ($mahasiswa) {
                $query->where('mahasiswa_id', $mahasiswa->id);
            })
            ->paginate(10);

        return view('mahasiswa.project', compact('dataTugas', 'dataProject'), ['title' => 'Detail Project']);
    }

    public function uploadProject(Request $request)
    {
        $request->validate([
            'project_id' => ['required', 'exists:project,id'],
            'tugas_id' => ['required', 'exists:tugas,id'],
            'nama_file_project' => ['required'],
            'file_project' => ['required', 'mimes:pdf'],
        ]);

        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->firstOrFail();

        // dd($mahasiswa);

        $project = Project::findOrFail($request->project_id);

        // Jika ada file baru, simpan dan update jalurnya
        if ($request->hasFile('file_project')) {
            $file = $request->file('file_project');
            $namaFile = $request->nama_file_project . '.' . $file->getClientOriginalExtension();
            $jalur = $file->storeAs('Tugas-Mahasiswa', $namaFile, 'public');
            $project->file_project = $jalur;

            $project->update([
                'nama_file_project' => $namaFile,
                'file_project' => $jalur,
                'status' => 'Sudah Submit'
            ]);
        } else {
            $project->update([
                'status' => 'Belum Submit'
            ]);
        }

        $mahasiswa->project()->attach($project->id);

        $mahasiswa->tugas()->attach($request->tugas_id);

        return redirect()->back();
    }

    public function updateProject(Request $request)
    {
        $project = Project::findOrFail($request->project_id);

        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->firstOrFail();

        $request->validate([
            'project_id' => ['required', 'exists:project,id'],
            'nama_file_project' => ['required'],
            'file_project' => ['nullable', 'mimes:pdf'],
        ]);

        if ($request->hasFile('file_project')) {
            if ($project->file_project && Storage::disk('public')->exists($project->file_project)) {
                Storage::disk('public')->delete($project->file_project);
            }

            $file = $request->file('file_project');
            $namaFile = $request->nama_file_project . '.' . $file->getClientOriginalExtension();
            $jalur = $file->storeAs('Tugas-Mahasiswa', $namaFile, 'public');

            $project->update([
                'nama_file_project' => $namaFile,
                'file_project' => $jalur,
            ]);
        } else {
            // Kalau tidak upload file baru, tetap update status
            $project->update([
                'nama_file_project' => $request->nama_file_project,
            ]);
        }

        $mahasiswa->project()->attach($project->id);

        return redirect()->back();
    }

    public function deleteProject(Request $request) {}
}
