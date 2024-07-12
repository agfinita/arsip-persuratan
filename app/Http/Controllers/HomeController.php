<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function hitungTotal() {
        // Jumlah surat diarsipkan
        $totalArsipSurat  = ArsipSurat::count();
        // Jumlah kategori surat
        $totalKategori    = KategoriSurat::count();

        return view('index', compact('totalArsipSurat', 'totalKategori'));
    }
}
