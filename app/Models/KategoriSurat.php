<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    use HasFactory;

    protected $table    = 'kategori_surat';

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    // Relasi one to many dengan arsip surat
    public function arsipSurat() {
        return $this->hasMany(ArsipSurat::class, 'kategori_id');
    }
}