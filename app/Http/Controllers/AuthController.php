<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginAdmin()
    {
        return view('auth.admin.login');
    }
    public function loginDokter()
    {
        return view('auth.dokter.login');
    }
    public function loginMahasiswa()
    {
        return view('auth.mahasiswa.login');
    }

    public function authAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('account')->attempt($credentials)) {
            $request->session()->regenerate();

            $account = Auth::guard('account')->user();

            if ($account->role === 'Admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::guard('account')->logout();
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    public function authMahasiswa(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('account')->attempt($credentials)) {
            $request->session()->regenerate();

            $account = Auth::guard('account')->user();

            if ($account->role === 'Mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            } else {
                Auth::guard('account')->logout();
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    public function authDokter(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('account')->attempt($credentials)) {
            $request->session()->regenerate();

            $account = Auth::guard('account')->user();

            if ($account->role === 'Dokter') {
                return redirect()->route('dokter.dashboard');
            } else {
                Auth::guard('account')->logout();
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    public function logoutAdmin()
    {
        Auth::guard('account')->logout();

        return redirect()->route('login.admin');
    }
    public function logoutDokter()
    {
        Auth::guard('account')->logout();

        return redirect()->route('login.dokter');
    }
    public function logoutMahasiswa()
    {
        Auth::guard('account')->logout();

        return redirect()->route('login.mahasiswa');
    }
}
