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

        $data = Mahasiswa::where('account_id', $account)->first();

        return view('mahasiswa.dashboard', compact('data'));
    }
}
