<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDiarsip extends Model
{
    use HasFactory;

    protected $table    = 'surat_diarsip';

    protected $fillable = [
        'nomor_surat',
        'id_kategori',
        'judul',
        'files'
    ];

    public function kategoriSurat()
    {
        return $this->belongsTo(KategoriSurat::class, 'id_kategori');
    }
}
