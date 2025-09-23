<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Project;
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
        $idAkun = Auth::guard('account')->id();
        $mahasiswa = Mahasiswa::where('account_id', $idAkun)->firstOrFail();

        $data_tugas = $mahasiswa->tugas()->with('project')->where('mahasiswa_id', $mahasiswa->id)->paginate(10);

        // dd($data_tugas);

        return view('mahasiswa.tugas', compact('data_tugas'), ['title' => 'Data Tugas', 'header' => 'Data Tugas']);
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

        $project = Project::findOrFail($request->project_id);

        // Jika ada file baru, simpan dan update jalurnya
        if ($request->hasFile('file_project')) {
            $file = $request->file('file_project');
            $namaFile = time() . '-' . $request->nama_file_project . '.' . $file->getClientOriginalExtension();
            $jalur = $file->storeAs('Tugas-Mahasiswa', $namaFile, 'public');
            $project->file_project = $jalur;

            $project->update([
                'nama_file_project' => $namaFile,
                'file_project' => $jalur,
                'status' => 'Sudah Submit'
            ]);
        } else {
            $project->update([
                'status' => 'Sudah Submit'
            ]);
        }

        $mahasiswa->project()->attach($project->id);

        return redirect()->back();
    }
}
