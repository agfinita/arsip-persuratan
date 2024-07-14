<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratDiarsip;
use Illuminate\Http\Request;
use App\Models\KategoriSurat;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Dashboard
    public function hitungTotal() {
        // Jumlah surat diarsipkan
        $totalArsipSurat  = SuratDiarsip::count();
        // Jumlah kategori surat
        $totalKategori    = KategoriSurat::count();

        return view('index', compact('totalArsipSurat', 'totalKategori'));
    }

    // Menampilkan halaman login
    public function masuk() {
        return view('login');
    }

    // Handle proses login
    public function authenticate(Request $request) {
        $request->validate([
            'email'     => 'required|email',
            'password'  =>  'required|min:8'
        ]);

        // Pengecekan apakah pengguna ada berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika tidak ada pengguna dengan email tersebut
            return back()->withErrors(['email' => 'Akun tidak terdaftar.'])->withInput($request->except('password'));
        }

        // Save input ketika berhasil divalidasi
        $credentials = $request->only('email', 'password');

        // Pengecekan login
        if(Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah pengguna terdaftar dan aktif
            if ($user->is_active != 1) {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun tidak aktif.');
            }

            // Pemeriksaan session
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // Mengembalikan pesan kesalahan jika login gagal
        return back()
            ->withInput($request->except('password'))
            ->withErrors(['email' => 'Email atau password salah!']);
    }

    //Logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();  //menghapus sesi

        $request->session()->regenerateToken(); //generate token baru

        return redirect('/');
    }
}
