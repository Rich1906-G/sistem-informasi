<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
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
            } elseif ($account->role === 'Prodi') {
                return redirect()->route('prodi.dashboard');
            } elseif ($account->role === 'Mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::guard('account')->logout();

        return redirect()->route('login');
    }
}
