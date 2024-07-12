<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriSurat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KategoriSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian
        $valueCari = $request->input('cari');

        // Jika ada nilai pencarian, tampilkan hasil pencarian
        if ($valueCari) {
            $kategoriSurat = KategoriSurat::where('nama_kategori', 'like', '%' . $valueCari . '%')
                ->orWhere('keterangan', 'like', '%' . $valueCari . '%')
                ->orderBy('id')
                ->get();
        } else {
            // Jika tidak ada nilai pencarian, tampilkan semua data kategori
            $kategoriSurat = KategoriSurat::orderBy('id')->get();
        }

        return view('kategori.index', compact('kategoriSurat', 'valueCari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil ID terbesar dari tabel KategoriSurat
        $latestCategory = KategoriSurat::orderBy('id', 'desc')->first();

        // Jika tidak ada data, ID dimulai dari 1
        $incrementId = $latestCategory ? $latestCategory->id + 1 : 1;

        return view('kategori.create', compact('incrementId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'category_id'   => 'required',
            'category_name' => 'required|string|max:50',
            'keterangan'    => 'required|string|max:100',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validatedData->errors()
            ], 422);
        }

        // Menyimpan hasil validasi yang sukses
        $validatedData = $validatedData->validated();

        // Menyimpan ke dalam database
        DB::table('kategori_surat')->insert([
            'id'              => $validatedData['category_id'],
            'nama_kategori'   => $validatedData['category_name'],
            'keterangan'      => $validatedData['keterangan'],
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriSurat $kategoriSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoriSurat  = KategoriSurat::find($id);

        if(!$kategoriSurat) {
            return redirect('/arsip/kategori')->with('error', 'Data tidak ditemukan');
        }

        return view('kategori.edit', compact('kategoriSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData  = $request->validate([
            'category_id'   => 'required',
            'category_name' => 'required|string|max:50',
            'keterangan'    => 'required|string|max:100',
        ]);

        $kategoriSurat = KategoriSurat::find($id);
        if (!$kategoriSurat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $kategoriSurat->update([
            'id'              => $validatedData['category_id'],
            'nama_kategori'   => $validatedData['category_name'],
            'keterangan'      => $validatedData['keterangan'],
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategoriSurat = DB::table('kategori_surat')->where('id', $id)->first();

        if ($kategoriSurat) {
            $kategoriSurat = DB::table('kategori_surat')->where('id', $id)->delete();

            return redirect('/arsip/kategori');
        }

        return redirect('/arsip/kategori')->with('error', 'Data tidak ditemukan');
    }
}
