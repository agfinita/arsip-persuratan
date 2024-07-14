<?php

namespace App\Http\Controllers;

use App\Models\SuratDiarsip;
use Illuminate\Http\Request;
use App\Models\KategoriSurat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SuratDiarsipController extends Controller
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
            $arsipSurat = SuratDiarsip::where('judul', 'like', '%' . $valueCari . '%')
                            ->orWhereHas('kategoriSurat', function ($query) use ($valueCari) {
                                $query->where('nama_kategori', 'like', '%' . $valueCari . '%');
                            })
                            ->with('kategoriSurat')
                            ->paginate(2);
        } else {
            // Jika tidak ada nilai pencarian, tampilkan semua data
            $arsipSurat = SuratDiarsip::orderBy('id')
                            ->with('kategoriSurat')
                            ->paginate(2);
        };

        return view('arsip.index', compact('arsipSurat', 'valueCari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua kategori surat dari database
        $kategoriSurat = KategoriSurat::all();

        return view('arsip.create', compact('kategoriSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nomor_surat'   => 'required',
            'id_kategori'   => 'required',
            'judul'         => 'required',
            'file_surat'    => 'required|mimes:pdf',
            'waktu_arsip'   => 'required|date_format:Y-m-d\TH:i'
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle upload file
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');

            // Generate nama file unik
            $originalname = $file->getClientOriginalName();
            $filename = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path = $file->storeAs('uploads', $filename, 'public');

            // Simpan path ke dalam array data validasi
            $validatedData['uploaded_file'] = $path;
        }

        // Menyimpan ke dalam database
        DB::table('surat_diarsip')->insert([
            'nomor_surat'   => $request->nomor_surat,
            'id_kategori'   => $request->id_kategori,
            'judul'         => $request->judul,
            'uploaded_file' => $validatedData['uploaded_file'],
            'created_at'    => $request->waktu_arsip
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil arsip surat berdasarkan id
        $arsipSurat = SuratDiarsip::with('kategoriSurat')->findOrFail($id);

        return view('arsip.show', compact('arsipSurat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $arsipSurat = SuratDiarsip::findOrFail($id);
        $kategoriSurat = KategoriSurat::all();

        return view('arsip.edit', compact('arsipSurat', 'kategoriSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nomor_surat'   => 'required',
            'id_kategori'   => 'required',
            'judul'         => 'required',
            'file_surat'    => 'sometimes|mimes:pdf',
            'waktu_arsip'   => 'required|date_format:Y-m-d\TH:i'
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Ambil data arsip berdasar id
        $arsipSurat = SuratDiarsip::findOrFail($id);

        // Update data arsip surat
        $arsipSurat->nomor_surat    = $request->nomor_surat;
        $arsipSurat->id_kategori    = $request->id_kategori;
        $arsipSurat->judul          = $request->judul;
        $arsipSurat->created_at     = $request->waktu_arsip;

        // Handle upload file
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');

            // Generate nama file unik
            $originalname = $file->getClientOriginalName();
            $filename = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path = $file->storeAs('uploads', $filename, 'public');

            // Hapus file lama jika ada
            if ($arsipSurat->uploaded_file && Storage::disk('public')->exists($arsipSurat->uploaded_file)) {
                Storage::disk('public')->delete($arsipSurat->uploaded_file);
            }

            // Update path ke dalam database
            $arsipSurat->uploaded_file = $path;
        }

        // Simpan perubahan
        $arsipSurat->save();

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan arsip surat berdasarkan ID
        $arsipSurat = SuratDiarsip::find($id);

        // Pastikan data ditemukan sebelum melakukan penghapusan
        if (!$arsipSurat) {
            return response()->json(['status' => 'error', 'message' => 'Data not found.'], 404);
        }

        // Hapus file dari local storage jika ada
        if ($arsipSurat->uploaded_file && Storage::disk('public')->exists($arsipSurat->uploaded_file)) {
            Storage::disk('public')->delete($arsipSurat->uploaded_file);
        }

        // Hapus data dari database
        $arsipSurat->delete();

        return view('arsip.index')->with('status', 'success');
    }
}
