<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ Kalau employee → langsung ke halaman contract
        if ($user->hasRole('Employee')) {
            return redirect()->intended(route('employee.contracts.index'))
                ->with('OK', 'Login berhasil');
        }

        // HRD / Admin → dashboard seperti biasa
        return redirect()->intended('/')
            ->with('OK', 'Login berhasil');
    }

    return redirect()->back()
        ->with('ERR', 'Username atau Password yang anda masukkan salah');
}

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
